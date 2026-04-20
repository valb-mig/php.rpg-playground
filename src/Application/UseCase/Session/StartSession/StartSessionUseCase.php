<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\StartSession;

use Eco\Result;
use RPGKernel\Application\UseCase\Session\StartSession\StartSessionInput;
use RPGKernel\Application\UseCase\Session\StartSession\StartSessionOutput;
use RPGKernel\Core\Handler\RPGSessionEventHandler;
use RPGKernel\Domain\Enums\SessionStatus;
use RPGKernel\Domain\Events\Session\StartedSessionEvent;

final class StartSessionUseCase
{
    /**
     * @param StartSessionInput $input
     * @return Result<StartSessionOutput>
     */
    public static function handle(StartSessionInput $input): Result
    {
        $session = $input->session;

        $session->setStatus(SessionStatus::STARTED);

        RPGSessionEventHandler::dispatch(new StartedSessionEvent($session));

        return Result::ok(new StartSessionOutput(session: $session));
    }
}
