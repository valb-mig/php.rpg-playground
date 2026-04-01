<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\Character\Statistics;

use RPGPlayground\Domain\ValueObjects\Character\Statistic;

final class GenericStatistic extends Statistic
{
    private int $current;

    public function __construct(
        private readonly string $key,
        private readonly int $max,
    ) {
        $this->current = 0;
    }

    /**
     * @return string
     */
    #[\Override]
    public function key(): string
    {
        return $this->key;
    }

    /**
     * @return int
     */
    #[\Override]
    public function current(): int
    {
        return $this->current;
    }

    /**
     * @param int $value
     * @return static
     */
    #[\Override]
    public function increase(int $value): static
    {
        if ($this->current >= $this->max) {
            return $this;
        }

        $clone = clone $this;
        $clone->current = $this->current + $value;
        return $clone;
    }

    /**
     * @param int $value
     * @return static
     */
    #[\Override]
    public function decrease(int $value): static
    {
        if ($this->current <= 0) {
            return $this;
        }
        $clone = clone $this;
        $clone->current = $this->current - $value;
        return $clone;
    }
}
