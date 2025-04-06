<?php

declare(strict_types=1);

namespace Rpg\Domain\ValueObject;

class Life
{
    public function __construct(
        protected int $current,
        protected int $max
    ){
        if($current > $max) {
            throw new \InvalidArgumentException('Invalid life');
        }
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function increment(int $points): void
    {
        if(($this->current + $points) > $this->max) {
            $this->current = $this->max;
            return;
        }

        $this->current += $points;
    }

    public function decrement(int $points): void
    {
        if(($this->current - $points) < 0) {
            $this->current = 0;
            return;
        }

        $this->current -= $points;
    }
}  