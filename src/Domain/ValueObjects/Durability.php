<?php

declare(strict_types=1);

namespace RPGKernel\Domain\ValueObjects;

final class Durability
{
    public function __construct(
        private int $current,
        private int $max,
    ) {
        if ($max < 1 || $current < 0 || $current > $max) {
            throw new \InvalidArgumentException('Durability cannot be less than 1 or greater than max');
        }
    }

    /**
     * @param int $value
     * @return self
     */
    public function increase(int $value): self
    {
        return new self(min($this->current + $value, $this->max), $this->max);
    }

    /**
     * @param int $value
     * @return self
     */
    public function decrease(int $value): self
    {
        return new self(max($this->current - $value, 0), $this->max);
    }
}
