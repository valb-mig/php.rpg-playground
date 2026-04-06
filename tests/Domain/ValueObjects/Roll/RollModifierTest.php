<?php

declare(strict_types=1);

namespace RPGKernel\Tests\Domain\ValueObjects\Roll;

use PHPUnit\Framework\TestCase;
use RPGKernel\Domain\ValueObjects\Roll\RollModifier;

final class RollModifierTest extends TestCase
{
    // -------------------------------------------------------------------------
    // fromString — happy path
    // -------------------------------------------------------------------------

    #[\PHPUnit\Framework\Attributes\DataProvider('validModifierProvider')]
    public function test_from_string_parses_symbol_and_value(
        string $modifier,
        string $expectedSymbol,
        int $expectedValue,
    ): void {
        $dm = RollModifier::fromString($modifier);

        $this->assertSame($expectedSymbol, $dm->symbol);
        $this->assertSame($expectedValue, $dm->value);
    }

    /**
     * @return array<array{string, string, int}>
     */
    public static function validModifierProvider(): array
    {
        return [
            'plus' => ['+5', '+', 5],
            'minus' => ['-3', '-', 3],
            'multiply star' => ['*2', '*', 2],
            'multiply x' => ['x2', 'x', 2],
            'divide slash' => ['/4', '/', 4],
            'large value' => ['+100', '+', 100],
        ];
    }

    // -------------------------------------------------------------------------
    // fromString — validation
    // -------------------------------------------------------------------------

    public function test_from_string_throws_on_invalid_symbol(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid modifier symbol: o');

        RollModifier::fromString('o2');
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('invalidSymbolProvider')]
    public function test_from_string_throws_for_unknown_symbols(string $modifier): void
    {
        $this->expectException(\InvalidArgumentException::class);

        RollModifier::fromString($modifier);
    }

    /**
     * @return array<array{string}>
     */
    public static function invalidSymbolProvider(): array
    {
        return [
            'letter o' => ['o2'],
            'hash' => ['#5'],
            'percent' => ['%2'],
            'at sign' => ['@3'],
            'digit' => ['52'],
        ];
    }

    // -------------------------------------------------------------------------
    // apply — each operator
    // -------------------------------------------------------------------------

    public function test_apply_addition(): void
    {
        $result = RollModifier::fromString('+5')->apply(10);

        $this->assertSame(15, $result);
    }

    public function test_apply_subtraction(): void
    {
        $result = RollModifier::fromString('-3')->apply(10);

        $this->assertSame(7, $result);
    }

    public function test_apply_multiplication_star(): void
    {
        $result = RollModifier::fromString('*2')->apply(10);

        $this->assertSame(20, $result);
    }

    public function test_apply_multiplication_x(): void
    {
        $result = RollModifier::fromString('x2')->apply(10);

        $this->assertSame(20, $result);
    }

    public function test_apply_division_slash(): void
    {
        $result = RollModifier::fromString('/4')->apply(20);

        $this->assertSame(5, $result);
    }

    // -------------------------------------------------------------------------
    // apply — edge cases
    // -------------------------------------------------------------------------

    public function test_apply_division_rounds_up_with_ceil(): void
    {
        // 10 / 3 = 3.33... → ceil → 4
        $result = RollModifier::fromString('/3')->apply(10);

        $this->assertSame(4, $result);
    }

    public function test_apply_subtraction_can_go_negative(): void
    {
        $result = RollModifier::fromString('-15')->apply(10);

        $this->assertSame(-5, $result);
    }
}
