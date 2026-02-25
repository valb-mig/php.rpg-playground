<?php

namespace RPGPlayground\Domain\Entities;

final class Dice
{
    public const MINIMUN_VALUE = 1;

    public function __construct(
        private int $maximum
    ){
        if($maximum < self::MINIMUN_VALUE)
        {
            throw new \InvalidArgumentException("Oxi");
        }
    }

    public function getDiceMaximum(): int
    {
        return $this->maximum;
    }
}