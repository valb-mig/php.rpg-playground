<?php
declare(strict_types=1);

namespace RPGPlayground\Tests\Infrastructure\EntryPoints\Console\Dice;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Infrastructure\EntryPoints\Console\Dice\RollDiceCommand;
use Symfony\Component\Console\Tester\CommandTester;

final class RollDiceCommandTest extends TestCase
{
    private CommandTester $tester;

    protected function setUp(): void
    {
        $this->tester = new CommandTester(new RollDiceCommand());
    }

    public function testRollDiceSuccessfully(): void
    {
        $this->tester->execute(['dice_params' => '1d20']);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('RESULT', $this->tester->getDisplay());
    }

    public function testRollDiceWithMultiplier(): void
    {
        $this->tester->execute(['dice_params' => '3d6']);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('3x d6', $this->tester->getDisplay());
    }

    public function testRollDiceWithPositiveModifier(): void
    {
        $this->tester->execute(['dice_params' => '2d10+5']);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('+5', $this->tester->getDisplay());
    }

    public function testRollDiceWithMultipleModifiers(): void
    {
        $this->tester->execute(['dice_params' => '2d10+5-3']);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('+5 -3', $this->tester->getDisplay());
    }

    public function testRollDiceWithoutMultiplierDefaultsToOne(): void
    {
        $this->tester->execute(['dice_params' => 'd20']);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('1x d20', $this->tester->getDisplay());
    }

    public function testDisplayShowsCorrectEntry(): void
    {
        $this->tester->execute(['dice_params' => '2d6+3']);

        $this->assertStringContainsString('2d6+3', $this->tester->getDisplay());
    }

    public function testDisplayShowsNoneWhenNoModifiers(): void
    {
        $this->tester->execute(['dice_params' => '1d6']);

        $this->assertStringContainsString('None', $this->tester->getDisplay());
    }

    public function testThrowsExceptionOnInvalidFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid dice parameters');

        $this->tester->execute(['dice_params' => 'invalid_input']);
    }

    public function testThrowsExceptionWhenMissingDiceNotation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->tester->execute(['dice_params' => '20']);
    }

    public function testThrowsExceptionWhenSidesIsBelowMinimum(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Dice sides must be at least');

        $this->tester->execute(['dice_params' => '1d0']);
    }

    public function testAsksForInputWhenNoArgumentProvided(): void
    {
        $this->tester->setInputs(['2d6+3']);
        $this->tester->execute([]);

        $this->tester->assertCommandIsSuccessful();
        $this->assertStringContainsString('2x d6', $this->tester->getDisplay());
    }
}