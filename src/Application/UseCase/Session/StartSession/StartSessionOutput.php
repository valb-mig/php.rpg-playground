<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\StartSession;

use RPGKernel\Domain\Entities\Session;

final class StartSessionOutput
{
    public function __construct(
        public readonly Session $session,
    ) {}
}
