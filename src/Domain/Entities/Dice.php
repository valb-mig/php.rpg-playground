<?php

namespace RPGPlayground\Domain\Entities;

// $rollage = (new Dice())

final class Dice
{
    private const MINIMUN_VALUE = 1;

    public int $max;
    private int $value;

    /**
     * @param int $max
     */
    public function __construct(int $max)
    {
        if(empty($max)) {
            throw new \InvalidArgumentException('Max value must be set');
        }

        if ($max < self::MINIMUN_VALUE) {
            throw new \InvalidArgumentException('Max value must be greater than 1');
        }

        $this->max = $max;
        $this->value = $this->roll();
    }

    /**
     * @return int
     */
    private function roll(): void
    {
        $this->value = mt_rand(self::MINIMUN_VALUE, $this->max);
    }

    /**
     * @param int $integer
     */
    public function increment(int $integer): int
    {
        $this->value += $integer;
        return $this->value;
    }

    /**
     * @param int $integer
     */
    public function decrement(int $integer): int
    {
        $this->value -= $integer;
        return $this->value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}