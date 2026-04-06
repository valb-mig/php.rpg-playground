<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Dice\RollDice;

use Eco\Error;
use Eco\Result;
use RPGKernel\Domain\Enums\Roll\RollAttribute;
use RPGKernel\Domain\ValueObjects\Dice;
use RPGKernel\Domain\ValueObjects\Roll\RollModifier;

final class RollDiceInput
{
    /**
     * @param Dice $dice The dice to roll
     * @param array<RollModifier> $modifiers The modifiers to apply to the roll
     * @param int $multiplier The number of times to roll the dice
     * @param RollAttribute $attribute The attributes to apply to the roll
     * @throws \InvalidArgumentException
     */
    private function __construct(
        public readonly Dice $dice,
        public readonly array $modifiers,
        public readonly int $multiplier = 1,
        public readonly ?RollAttribute $attribute = null,
    ) {}

    /**
     * @param Dice $dice The dice to roll
     * @param array<RollModifier> $modifiers The modifiers to apply to the roll
     * @param int $multiplier The number of times to roll the dice
     * @return Result<self>
     * */
    public static function create(
        Dice $dice,
        array $modifiers = [],
        int $multiplier = 1,
        ?RollAttribute $attribute = null,
    ): Result {
        try {
            if ($multiplier < 1) {
                throw new \InvalidArgumentException('Multiplier must be greater than or equal to 1.');
            }

            return Result::ok(new self($dice, $modifiers, $multiplier, $attribute));
        } catch (\InvalidArgumentException $e) {
            return Result::fail(Error::generic($e->getMessage()));
        }
    }
}
