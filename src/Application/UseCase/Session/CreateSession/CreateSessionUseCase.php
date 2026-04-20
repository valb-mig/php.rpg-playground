<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\CreateSession;

use Eco\Error;
use Eco\Result;
use RPGKernel\Core\Handler\RPGSessionEventHandler;
use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Entities\Session;
use RPGKernel\Domain\Enums\SessionStatus;
use RPGKernel\Domain\Events\Session\CreatedSessionEvent;

final class CreateSessionUseCase
{
    /**
     * @param CreateSessionInput $input
     * @return Result<CreateSessionOutput>
     */
    public static function handle(CreateSessionInput $input): Result
    {
        try {
            $session = new Session(identifier: Identifier::generate(), name: $input->name, createdAt: new \DateTime());
            $session->setStatus(SessionStatus::CREATED);

            RPGSessionEventHandler::dispatch(new CreatedSessionEvent($session));

            return Result::ok(new CreateSessionOutput(session: $session));
        } catch (\Exception $e) {
            return Result::fail(Error::generic($e->getMessage()));
        }
    }
}
