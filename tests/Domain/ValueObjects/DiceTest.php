<?php

declare(strict_types=1);

namespace RPGPlayground\Tests\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\ValueObjects\Dice;

final class DiceTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_dice_is_created_with_valid_sides(): void
    {
        $dice = new Dice(20);

        $this->assertSame(20, $dice->sides);
    }

    public function test_minimum_value_constant_is_one(): void
    {
        $this->assertSame(1, Dice::MINIMUM_VALUE);
    }

    public function test_d1_is_valid(): void
    {
        $dice = new Dice(1);

        $this->assertSame(1, $dice->sides);
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('commonDiceProvider')]
    public function test_common_dice_are_valid(int $sides): void
    {
        $dice = new Dice($sides);

        $this->assertSame($sides, $dice->sides);
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

    // -------------------------------------------------------------------------
    // Validation
    // -------------------------------------------------------------------------

    public function test_throws_on_zero_sides(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid number of sides for a dice');

        new Dice(0);
    }

    public function test_throws_on_negative_sides(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Dice(-1);
    }
}
