<?php
declare(strict_types=1);

namespace RPGPlayground\Domain\Entities;

final class Dice
{
    public const MINIMUN_VALUE = 1;

    public function __construct(
        private int $maximum
    ){
        if($maximum < self::MINIMUN_VALUE)
        {
            throw new \InvalidArgumentException("Dice maximum must be at least " . self::MINIMUN_VALUE);
        }
    }

    public function getDiceMaximum(): int
    {
        return $this->maximum;
    }
}