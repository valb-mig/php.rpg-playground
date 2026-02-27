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
        static::assertStringContainsString('RESULT', $this->tester->getDisplay());
    }

    public function testRollDiceWithMultiplier(): void
    {
        $this->tester->execute(['dice_params' => '3d6']);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('3x d6', $this->tester->getDisplay());
    }

    public function testRollDiceWithPositiveModifier(): void
    {
        $this->tester->execute(['dice_params' => '2d10+5']);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('+5', $this->tester->getDisplay());
    }

    public function testRollDiceWithMultipleModifiers(): void
    {
        $this->tester->execute(['dice_params' => '2d10+5-3']);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('+5 -3', $this->tester->getDisplay());
    }

    public function testRollDiceWithoutMultiplierDefaultsToOne(): void
    {
        $this->tester->execute(['dice_params' => '1d20']);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('1x d20', $this->tester->getDisplay());
    }

    public function testDisplayShowsCorrectEntry(): void
    {
        $this->tester->execute(['dice_params' => '2d6+3']);

        static::assertStringContainsString('2d6+3', $this->tester->getDisplay());
    }

    public function testDisplayShowsNoneWhenNoModifiers(): void
    {
        $this->tester->execute(['dice_params' => '1d6']);

        static::assertStringContainsString('None', $this->tester->getDisplay());
    }

    public function testAsksForInputWhenNoArgumentProvided(): void
    {
        $this->tester->setInputs(['2d6+3']);
        $this->tester->execute([]);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('2x d6', $this->tester->getDisplay());
    }
}
