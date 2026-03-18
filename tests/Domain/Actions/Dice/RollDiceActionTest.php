<?php

declare(strict_types=1);

namespace RPGPlayground\Tests\Domain\Actions\Dice;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\Actions\Dice\RollDiceAction;
use RPGPlayground\Domain\ValueObjects\Dice;

final class RollDiceActionTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Result range
    // -------------------------------------------------------------------------

    public function test_roll_returns_value_within_range(): void
    {
        $dice = new Dice(20);

        $result = RollDiceAction::roll($dice);

        $this->assertGreaterThanOrEqual(Dice::MINIMUM_VALUE, $result);
        $this->assertLessThanOrEqual(20, $result);
    }

    public function test_roll_never_returns_zero(): void
    {
        $dice = new Dice(6);

        for ($i = 0; $i < 100; $i++) {
            $this->assertGreaterThanOrEqual(Dice::MINIMUM_VALUE, RollDiceAction::roll($dice));
        }
    }

    public function test_roll_never_exceeds_sides(): void
    {
        $dice = new Dice(6);

        for ($i = 0; $i < 100; $i++) {
            $this->assertLessThanOrEqual(6, RollDiceAction::roll($dice));
        }
    }

    // -------------------------------------------------------------------------
    // D1 edge case
    // -------------------------------------------------------------------------

    public function test_d1_always_returns_one(): void
    {
        $dice = new Dice(1);

        for ($i = 0; $i < 10; $i++) {
            $this->assertSame(1, RollDiceAction::roll($dice));
        }
    }

    // -------------------------------------------------------------------------
    // Common dice types
    // -------------------------------------------------------------------------

    #[\PHPUnit\Framework\Attributes\DataProvider('commonDiceProvider')]
    public function test_roll_stays_within_range_for_common_dice(int $sides): void
    {
        $dice = new Dice($sides);
        $result = RollDiceAction::roll($dice);

        $this->assertGreaterThanOrEqual(Dice::MINIMUM_VALUE, $result);
        $this->assertLessThanOrEqual($sides, $result);
    }

    /**
     * @return array<array{int}>
     */
    public static function commonDiceProvider(): array
    {
        return [
            'D4' => [4],
            'D6' => [6],
            'D8' => [8],
            'D10' => [10],
            'D12' => [12],
            'D20' => [20],
            'D100' => [100],
        ];
    }
}
