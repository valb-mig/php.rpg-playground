<?php

declare(strict_types=1);

namespace Tests\Application\UseCase\Dice\RollDice;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGPlayground\Domain\ValueObjects\Dice;
use RPGPlayground\Domain\ValueObjects\Roll\RollModifier;

final class RollDiceInputTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_create_returns_ok_with_valid_dice(): void
    {
        $result = RollDiceInput::create(new Dice(20));

        $this->assertTrue($result->isOk());
    }

    public function test_dice_is_stored_correctly(): void
    {
        $dice = new Dice(20);
        $input = RollDiceInput::create($dice)->unwrap();

        $this->assertSame($dice, $input->dice);
    }

    public function test_modifiers_default_to_empty_array(): void
    {
        $input = RollDiceInput::create(new Dice(20))->unwrap();

        $this->assertSame([], $input->modifiers);
    }

    public function test_multiplier_defaults_to_one(): void
    {
        $input = RollDiceInput::create(new Dice(20))->unwrap();

        $this->assertSame(1, $input->multiplier);
    }

    public function test_modifiers_are_stored_correctly(): void
    {
        $modifiers = [
            RollModifier::fromString('+5'),
            RollModifier::fromString('-2'),
        ];

        $input = RollDiceInput::create(new Dice(20), $modifiers)->unwrap();

        $this->assertSame($modifiers, $input->modifiers);
    }

    public function test_multiplier_is_stored_correctly(): void
    {
        $input = RollDiceInput::create(new Dice(20), [], 3)->unwrap();

        $this->assertSame(3, $input->multiplier);
    }

    // -------------------------------------------------------------------------
    // Validation failures
    // -------------------------------------------------------------------------

    public function test_create_fails_with_multiplier_zero(): void
    {
        $result = RollDiceInput::create(new Dice(20), [], 0);

        $this->assertTrue($result->isFail());
    }

    public function test_create_fails_with_negative_multiplier(): void
    {
        $result = RollDiceInput::create(new Dice(20), [], -1);

        $this->assertTrue($result->isFail());
    }

    public function test_error_message_on_invalid_multiplier(): void
    {
        $result = RollDiceInput::create(new Dice(20), [], 0);
        $errors = $result->getErrorMessages();

        $this->assertContains('Multiplier must be greater than or equal to 1.', $errors);
    }
}
