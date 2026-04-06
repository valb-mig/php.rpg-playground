<?php

declare(strict_types=1);

namespace RPGKernel\Domain\ValueObjects\Character;

use RPGKernel\Domain\ValueObjects\Bundle;

final class Statistics extends Bundle
{
    /**
     * @param Statistic[] $statistics
     */
    public function __construct(Statistic ...$statistics)
    {
        // TODO: make this process more abstract and generic for other classes
        $bundleData = [];

        foreach ($statistics as $statistic) {
            $bundleData[$statistic->key()] = $statistic;
        }

        parent::__construct($bundleData);
    }
}

abstract class Statistic
{
    /**
     * @return string
     */
    abstract public function key(): string;

    /**
     * @return int
     */
    abstract public function current(): int;

    /**
     * @param int $value
     */
    abstract public function increase(int $value): static;

    /**
     * @param int $value
     */
    abstract public function decrease(int $value): static;
}
