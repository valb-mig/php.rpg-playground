<?php
declare(strict_types=1);

namespace RPGPlayground\Domain\Entities;

final class Dice
{
    public const MINIMUM_VALUE = 1;

    public function __construct(
        public readonly int $maximum
    ){
        if($maximum < self::MINIMUM_VALUE)
        {
            throw new \InvalidArgumentException("Dice maximum must be at least " . self::MINIMUM_VALUE);
        }
    }
}