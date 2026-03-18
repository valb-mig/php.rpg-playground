<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects;

final class DiceModifier
{
    public const array VALID_SYMBOLS = ['+', '-', '*', 'x', '/'];
    private const string MODIFIER_PATTERN = '/^([+\-\/x\*])(\d+)$/u';

    private function __construct(
        public readonly string $symbol,
        public readonly int $value,
    ) {}

    /**
     * @param string $modifier
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function fromString(string $modifier): self
    {
        $matches = [];

        if (!preg_match(self::MODIFIER_PATTERN, $modifier, $matches)) {
            throw new \InvalidArgumentException("Invalid modifier symbol: {$modifier}");
        }

        $modifier = $matches[1] ?? '';

        if (!in_array($modifier, self::VALID_SYMBOLS)) {
            throw new \InvalidArgumentException("Invalid modifier symbol: {$modifier}");
        }

        $value = (int) ($matches[2] ?? 0);

        if ($value < 1) {
            throw new \InvalidArgumentException('Modifier value must be greater than or equal to 1.');
        }

        return new self($modifier, $value);
    }

    /**
     * @param int $rollValue
     * @return int
     */
    public function apply(int $rollValue): int
    {
        return (int) ceil(match ($this->symbol) {
            '+' => $rollValue + $this->value,
            '-' => $rollValue - $this->value,
            '*', 'x' => $rollValue * $this->value,
            '/' => $this->value !== 0 ? $rollValue / $this->value : $rollValue,
        });
    }
}
