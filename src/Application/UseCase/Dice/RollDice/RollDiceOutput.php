<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Dice\RollDice;

final class RollDiceOutput
{
    public function __construct(
        public readonly int $rollValue,
    ) {}
}
