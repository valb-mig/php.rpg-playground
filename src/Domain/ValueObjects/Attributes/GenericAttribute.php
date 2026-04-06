<?php

declare(strict_types=1);

namespace RPGKernel\Domain\ValueObjects\Attributes;

use RPGKernel\Domain\ValueObjects\Attribute;

final class GenericAttribute extends Attribute
{
    public function __construct(
        private readonly string $key,
        private readonly string $description,
        private readonly int $value,
    ) {}

    /**
     * @return string
     */
    #[\Override]
    public function key(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    #[\Override]
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    #[\Override]
    public function value(): int
    {
        return $this->value;
    }
}
