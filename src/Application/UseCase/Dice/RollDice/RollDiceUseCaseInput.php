<?php
declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

use RPGPlayground\Domain\ValueObjects\App\Dice;

final class RollDiceUseCaseInput
{
    public function __construct(
        public readonly Dice $dice,
        public readonly array $modifiers,
        public readonly int $multiplier = 1
    ) {
        if($multiplier < 1) {
            throw new \InvalidArgumentException("Invalid multiplier");
        }
    }
}
