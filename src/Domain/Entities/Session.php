<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Entities;

use RPGPlayground\Domain\ValueObjects\Utils\Identifier;

final class Session
{
    public function __construct(
        public readonly string $name,
        public readonly Identifier $identifier,
        public readonly \DateTime $createdAt,
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Session name cannot be empty');
        }
    }
}
