<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Contracts\Event;

use RPGKernel\Core\Utils\Identifier;

interface RPGSessionEventContract
{
    public function occurredAt(): \DateTimeImmutable;

    public function sessionId(): Identifier;

    public function eventType(): string;

    public function payload(): array;
}
