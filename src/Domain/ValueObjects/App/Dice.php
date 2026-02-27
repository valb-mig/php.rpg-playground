<?php
declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\App;

final class Dice
{
    public const MINIMUM_VALUE = 1;

    public function __construct(
        public int $sides
    ){
        if($sides < self::MINIMUM_VALUE) {
            throw new \InvalidArgumentException("Invalid number of sides for a dice");
        }
    }
}