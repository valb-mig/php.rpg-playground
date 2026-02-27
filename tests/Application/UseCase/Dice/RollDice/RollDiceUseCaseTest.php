<?php
declare(strict_types=1);

namespace Tests\Application\UseCase\Dice\RollDice;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCaseInput;
use RPGPlayground\Domain\ValueObjects\App\Dice;

class RollDiceUseCaseTest extends TestCase
{
    public function testRollDice(): void
    {
        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2'];
        $multiplier = 2;

        $rollDice = new RollDiceUseCase();

        $result = $rollDice->run(
            new RollDiceUseCaseInput(
                $dice,
                $modifiers,
                $multiplier
            )
        );

        $this->assertFalse($result->isError());
        $this->assertIsNumeric($result->getData()->rollage);
    }

    public function testRollDiceWithInvalidMultiplier(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid multiplier");

        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2'];
        $multiplier = -1;

        $rollDice = new RollDiceUseCase();

        $result = $rollDice->run(
            new RollDiceUseCaseInput(
                $dice,
                $modifiers,
                $multiplier
            )
        );
    }

    public function testRollDiceWithInvalidModifier(): void
    {
        $dice = new Dice(20);
        $modifiers = ['+5', '-2', '*2', '/2', '%3'];
        $multiplier = 2;

        $rollDice = new RollDiceUseCase();

        $result = $rollDice->run(
            new RollDiceUseCaseInput(
                $dice,
                $modifiers,
                $multiplier
            )
        );

        $this->assertTrue($result->isError());
        $this->assertStringContainsString('Invalid modifier: %3', $result->getMessage());
    }
}