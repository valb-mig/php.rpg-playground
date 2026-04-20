<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Events\Session;

use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Contracts\Event\RPGSessionEventContract;
use RPGKernel\Domain\Entities\Session;

class CreatedSessionEvent implements RPGSessionEventContract
{
    public function __construct(
        public readonly Session $session,
    ) {}

    public function occurredAt(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }

    public function sessionId(): Identifier
    {
        return $this->session->getIdentifier();
    }

    public function eventType(): string
    {
        return 'session.created';
    }

    public function payload(): array
    {
        return [
            'sessionId' => $this->sessionId()->value,
            'type' => $this->eventType(),
            'status' => $this->session->getStatus(),
            'name' => $this->session->getName(),
            'createdAt' => $this->session->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
