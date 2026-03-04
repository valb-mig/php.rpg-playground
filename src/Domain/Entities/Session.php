<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Entities;

use RPGPlayground\Domain\ValueObjects\Utils\Identifier;

final class Session
{
    /**
     * @param string $name The name of the session
     * @param Identifier $identifier The unique identifier for the session
     * @param \DateTime $createdAt The date and time when the session was created
     * @throws \InvalidArgumentException if the session name is empty
     */
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
