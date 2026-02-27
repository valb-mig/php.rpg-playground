<?php
declare(strict_types=1);

namespace Tests\Application\UseCase;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Dice\RollDice;
use RPGPlayground\Domain\ValueObjects\App\Dice;

class RollDiceTest extends TestCase
{
    public function testRollDice(): void
    {
        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2'];
        $multiplier = 2;

        $rollDice = new RollDice();
        $result = $rollDice->run($dice, $modifiers, $multiplier);

        $this->assertFalse($result->isError());
        $this->assertStringContainsString('d20: ', $result->getMessage());
        $this->assertIsNumeric($result->getData());
    }

    public function testRollDiceWithInvalidMultiplier(): void
    {
        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2'];
        $multiplier = -1;

        $rollDice = new RollDice();
        $result = $rollDice->run($dice, $modifiers, $multiplier);

        $this->assertTrue($result->isError());
        $this->assertStringContainsString('Invalid multiplier', $result->getMessage());
    }

    public function testRollDiceWithInvalidModifier(): void
    {
        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2', '%3'];
        $multiplier = 2;

        $rollDice = new RollDice();
        $result = $rollDice->run($dice, $modifiers, $multiplier);

        $this->assertTrue($result->isError());
        $this->assertStringContainsString('Invalid modifier: %3', $result->getMessage());
    }
}