<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use RPGPlayground\Domain\ValueObjects\Dice;

final class RollDiceUseCaseInput
{
    /**
     * @param Dice $dice The dice to roll
     * @param array<string> $modifiers An array of modifiers to apply to the roll (e.g., +5, -2, x2)
     * @param int $multiplier The number of times to roll the dice
     * @throws \InvalidArgumentException
     */
    public function __construct(
        public readonly Dice $dice,
        public readonly array $modifiers,
        public readonly int $multiplier = 1,
    ) {
        if ($multiplier < 1) {
            throw new \InvalidArgumentException('Invalid multiplier');
        }
    }
}
