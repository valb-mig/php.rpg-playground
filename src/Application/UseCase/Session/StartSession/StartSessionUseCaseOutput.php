<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

use RPGPlayground\Domain\Entities\Session;

final class StartSessionUseCaseOutput
{
    public function __construct(
        public readonly Session $session,
    ) {}
}
