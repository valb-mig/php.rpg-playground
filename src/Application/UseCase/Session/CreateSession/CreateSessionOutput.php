<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\CreateSession;

use RPGKernel\Domain\Entities\Session;

final class CreateSessionOutput
{
    public function __construct(
        public readonly Session $session,
    ) {}
}
