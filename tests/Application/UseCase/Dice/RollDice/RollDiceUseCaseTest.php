<?php

declare(strict_types=1);

namespace Tests\Application\UseCase\Dice\RollDice;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceOutput;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCase;
use RPGPlayground\Domain\ValueObjects\Dice;
use RPGPlayground\Domain\ValueObjects\DiceModifier;

final class RollDiceUseCaseTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_handle_returns_ok(): void
    {
        $result = RollDiceUseCase::handle($this->makeInput(new Dice(20)));

        $this->assertTrue($result->isOk());
    }

    public function test_handle_returns_roll_dice_output(): void
    {
        $output = RollDiceUseCase::handle($this->makeInput(new Dice(20)))->unwrap();

        $this->assertInstanceOf(RollDiceOutput::class, $output);
    }

    public function test_roll_value_is_within_d20_range(): void
    {
        $output = RollDiceUseCase::handle($this->makeInput(new Dice(20)))->unwrap();

        $this->assertGreaterThanOrEqual(1, $output->rollValue);
        $this->assertLessThanOrEqual(20, $output->rollValue);
    }

    public function test_roll_value_is_within_d6_range(): void
    {
        $output = RollDiceUseCase::handle($this->makeInput(new Dice(6)))->unwrap();

        $this->assertGreaterThanOrEqual(1, $output->rollValue);
        $this->assertLessThanOrEqual(6, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Multiplier
    // -------------------------------------------------------------------------

    public function test_multiplier_accumulates_rolls(): void
    {
        // 3x D1 = always 3 (D1 always returns 1)
        $input = $this->makeInput(new Dice(1), multiplier: 3);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(3, $output->rollValue);
    }

    public function test_single_multiplier_matches_d1_roll(): void
    {
        $input = $this->makeInput(new Dice(1), multiplier: 1);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Modifiers
    // -------------------------------------------------------------------------

    public function test_addition_modifier_is_applied(): void
    {
        // D1 always rolls 1 → +4 = 5
        $input = $this->makeInput(new Dice(1), modifiers: [DiceModifier::fromString('+4')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    public function test_subtraction_modifier_is_applied(): void
    {
        // D1 always rolls 1 → -1 = 0
        $input = $this->makeInput(new Dice(1), modifiers: [DiceModifier::fromString('-1')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(0, $output->rollValue);
    }

    public function test_multiplication_modifier_is_applied(): void
    {
        // D1 always rolls 1 → x3 = 3
        $input = $this->makeInput(new Dice(1), modifiers: [DiceModifier::fromString('x3')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(3, $output->rollValue);
    }

    public function test_division_modifier_is_applied(): void
    {
        // 3x D1 = 3 → /3 = 1
        $input = $this->makeInput(new Dice(1), modifiers: [DiceModifier::fromString('/3')], multiplier: 3);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    public function test_multiple_modifiers_are_applied_in_order(): void
    {
        // D1 = 1 → +9 = 10 → /2 = 5
        $input = $this->makeInput(new Dice(1), modifiers: [
            DiceModifier::fromString('+9'),
            DiceModifier::fromString('/2'),
        ]);

        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    public function test_no_modifiers_returns_raw_roll(): void
    {
        // D1 always 1, no modifiers
        $input = $this->makeInput(new Dice(1));
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * @param Dice $dice
     * @param array<DiceModifier> $modifiers
     * @param int $multiplier
     * @return RollDiceInput
     */
    private function makeInput(Dice $dice, array $modifiers = [], int $multiplier = 1): RollDiceInput
    {
        return RollDiceInput::create($dice, $modifiers, $multiplier)->unwrap();
    }
}
