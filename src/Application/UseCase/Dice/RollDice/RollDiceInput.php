<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use Eco\Error;
use Eco\Result;
use RPGPlayground\Domain\ValueObjects\Dice;
use RPGPlayground\Domain\ValueObjects\DiceModifier;

final class RollDiceInput
{
    /**
     * @param Dice $dice The dice to roll
     * @param array<DiceModifier> $modifiers The modifiers to apply to the roll
     * @param int $multiplier The number of times to roll the dice
     * @throws \InvalidArgumentException
     */
    private function __construct(
        public readonly Dice $dice,
        public readonly array $modifiers,
        public readonly int $multiplier = 1,
    ) {}

    /**
     * @param Dice $dice The dice to roll
     * @param array<DiceModifier> $modifiers The modifiers to apply to the roll
     * @param int $multiplier The number of times to roll the dice
     * @return Result<self>
     * */
    public static function create(Dice $dice, array $modifiers = [], int $multiplier = 1): Result
    {
        try {
            if ($multiplier < 1) {
                throw new \InvalidArgumentException('Multiplier must be greater than or equal to 1.');
            }

            return Result::ok(new self($dice, $modifiers, $multiplier));
        } catch (\InvalidArgumentException $e) {
            return Result::fail(Error::generic($e->getMessage()));
        }
    }
}
