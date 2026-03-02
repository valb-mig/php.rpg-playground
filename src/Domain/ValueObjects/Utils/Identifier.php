<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\Utils;

final class Identifier
{
    private function __construct(
        public readonly string $value,
    ) {}

    public static function generate(): self
    {
        return new self(uniqid());
    }
}
