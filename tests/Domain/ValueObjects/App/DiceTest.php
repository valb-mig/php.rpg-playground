<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObjects\App;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\ValueObjects\App\Dice;

class DiceTest extends TestCase
{
    #[Test]
    public function shouldSucceedWhenCreateDice(): void
    {
        $dice = new Dice(20);
        static::assertInstanceOf(Dice::class, $dice);
        static::assertSame(20, $dice->sides);
    }

    #[Test]
    public function shouldFailWhenCreateDiceWithZeroSides(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Dice(0);
    }
}
