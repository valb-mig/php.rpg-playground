<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Utils\Identifier;

final class Session
{
    /**
     * @param string $name The name of the session
     * @param Identifier $identifier The unique identifier for the session
     * @param \DateTime $createdAt The date and time when the session was created
     */
    public function __construct(
        public readonly string $name,
        public readonly Identifier $identifier,
        public readonly \DateTime $createdAt,
    ) {}
}
