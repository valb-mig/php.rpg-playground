<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects;

final class Dice
{
    public const int MINIMUM_VALUE = 1;

    /**
     * @param int $sides
     * @throws \InvalidArgumentException
     */
    public function __construct(
        public readonly int $sides,
    ) {
        if ($sides < self::MINIMUM_VALUE) {
            throw new \InvalidArgumentException('Invalid number of sides for a dice');
        }
    }
}
