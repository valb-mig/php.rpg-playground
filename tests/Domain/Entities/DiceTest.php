<?php
declare(strict_types=1);

namespace Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\Entities\Dice;

class DiceTest extends TestCase
{
    public function testDiceCreation(): void
    {
        $dice = new Dice(20);
        $this->assertInstanceOf(Dice::class, $dice);
        $this->assertEquals(20, $dice->getDiceMaximum());
    }

    public function testInvalidDiceCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Dice(0);
    }
}