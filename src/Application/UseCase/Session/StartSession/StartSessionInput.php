<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\StartSession;

use Eco\Result;
use RPGKernel\Domain\Entities\Session;
use RPGKernel\Domain\Enums\SessionStatus;

final class StartSessionInput
{
    /**
     * @param Session $session
     */
    private function __construct(
        public Session $session,
    ) {}

    /** @return Result<self> */
    public static function create(Session $session): Result
    {
        return Result::ok(new self(session: $session));
    }
}
