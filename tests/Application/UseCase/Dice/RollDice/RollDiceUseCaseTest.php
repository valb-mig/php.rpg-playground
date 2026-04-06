<?php

declare(strict_types=1);

namespace Tests\Application\UseCase\Dice\RollDice;

use PHPUnit\Framework\TestCase;
use RPGKernel\Application\UseCase\Dice\RollDice\RollDiceInput;
use RPGKernel\Application\UseCase\Dice\RollDice\RollDiceOutput;
use RPGKernel\Application\UseCase\Dice\RollDice\RollDiceUseCase;
use RPGKernel\Domain\Enums\Roll\RollAttribute;
use RPGKernel\Domain\ValueObjects\Dice;
use RPGKernel\Domain\ValueObjects\Roll\RollModifier;

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
        $input = $this->makeInput(new Dice(1), modifiers: [RollModifier::fromString('+4')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    public function test_subtraction_modifier_is_applied(): void
    {
        // D1 always rolls 1 → -1 = 0
        $input = $this->makeInput(new Dice(1), modifiers: [RollModifier::fromString('-1')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(0, $output->rollValue);
    }

    public function test_multiplication_modifier_is_applied(): void
    {
        // D1 always rolls 1 → x3 = 3
        $input = $this->makeInput(new Dice(1), modifiers: [RollModifier::fromString('x3')]);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(3, $output->rollValue);
    }

    public function test_division_modifier_is_applied(): void
    {
        // 3x D1 = 3 → /3 = 1
        $input = $this->makeInput(new Dice(1), modifiers: [RollModifier::fromString('/3')], multiplier: 3);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    public function test_multiple_modifiers_are_applied_in_order(): void
    {
        // D1 = 1 → +9 = 10 → /2 = 5
        $input = $this->makeInput(new Dice(1), modifiers: [
            RollModifier::fromString('+9'),
            RollModifier::fromString('/2'),
        ]);

        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    public function test_no_modifiers_returns_raw_roll(): void
    {
        $input = $this->makeInput(new Dice(1));
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Advantage
    // -------------------------------------------------------------------------

    public function test_advantage_returns_highest_of_two_d1_rolls(): void
    {
        // D1 always rolls 1 — max([1, 1]) = 1
        $input = $this->makeInput(new Dice(1), attribute: RollAttribute::Advantage);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    public function test_advantage_result_is_within_dice_range(): void
    {
        $input = $this->makeInput(new Dice(20), attribute: RollAttribute::Advantage);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertGreaterThanOrEqual(1, $output->rollValue);
        $this->assertLessThanOrEqual(20, $output->rollValue);
    }

    public function test_advantage_with_modifier_applied_after(): void
    {
        // D1 advantage = max([1, 1]) = 1 → +4 = 5
        $input = $this->makeInput(
            new Dice(1),
            modifiers: [RollModifier::fromString('+4')],
            attribute: RollAttribute::Advantage,
        );
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Disadvantage
    // -------------------------------------------------------------------------

    public function test_disadvantage_returns_lowest_of_two_d1_rolls(): void
    {
        // D1 always rolls 1 — min([1, 1]) = 1
        $input = $this->makeInput(new Dice(1), attribute: RollAttribute::Disadvantage);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(1, $output->rollValue);
    }

    public function test_disadvantage_result_is_within_dice_range(): void
    {
        $input = $this->makeInput(new Dice(20), attribute: RollAttribute::Disadvantage);
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertGreaterThanOrEqual(1, $output->rollValue);
        $this->assertLessThanOrEqual(20, $output->rollValue);
    }

    public function test_disadvantage_with_modifier_applied_after(): void
    {
        // D1 disadvantage = min([1, 1]) = 1 → +4 = 5
        $input = $this->makeInput(
            new Dice(1),
            modifiers: [RollModifier::fromString('+4')],
            attribute: RollAttribute::Disadvantage,
        );
        $output = RollDiceUseCase::handle($input)->unwrap();

        $this->assertSame(5, $output->rollValue);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * @param Dice                $dice
     * @param array<RollModifier> $modifiers
     * @param int                 $multiplier
     * @param RollAttribute|null  $attribute
     */
    private function makeInput(
        Dice $dice,
        array $modifiers = [],
        int $multiplier = 1,
        ?RollAttribute $attribute = null,
    ): RollDiceInput {
        return RollDiceInput::create($dice, $modifiers, $multiplier, $attribute)->unwrap();
    }
}
