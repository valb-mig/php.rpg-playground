<?php

declare(strict_types=1);

namespace RPGKernel\Domain\ValueObjects\Character\Statistics;

use RPGKernel\Domain\ValueObjects\Character\Statistic;

final class Health extends Statistic
{
    private const string KEY = 'health';

    private int $current;

    /**
     * @param int $max
     */
    public function __construct(
        public readonly int $max,
    ) {
        $this->current = $max;
    }

    /**
     * @return string
     */
    #[\Override]
    public function key(): string
    {
        return self::KEY;
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
