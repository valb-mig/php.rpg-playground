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

    /**
     * Returns the result of rolling a dice with the given number of sides.
     * @return int The result of the roll.
     * @throws \Random\RandomException if the system entropy source fails.
     */
    public function roll(): int
    {
        return random_int(self::MINIMUM_VALUE, $this->sides);
    }
}
