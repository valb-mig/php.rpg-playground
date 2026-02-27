<?php
declare(strict_types=1);

namespace Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\ValueObjects\App\Dice;

class DiceTest extends TestCase
{
    public function testDiceCreation(): void
    {
        $dice = new Dice(20);
        $this->assertInstanceOf(Dice::class, $dice);
        $this->assertEquals(20, $dice->sides);
    }

    public function testInvalidDiceCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Dice(0);
    }
}