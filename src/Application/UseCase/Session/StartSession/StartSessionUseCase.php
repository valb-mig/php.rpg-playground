<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionUseCaseOutput;
use RPGPlayground\Domain\Entities\Session;
use RPGPlayground\Domain\ValueObjects\Utils\Identifier;
use RPGPlayground\Domain\ValueObjects\Utils\Result;

final class StartSessionUseCase
{
    /**
     * @return Result<StartSessionUseCaseOutput>
     */
    public function run(StartSessionUseCaseInput $input): Result
    {
        try {
            $resultStartSession = new StartSessionUseCaseOutput(session: new Session(
                name: $input->name,
                identifier: Identifier::generate(),
                createdAt: new \DateTime(),
            ));

            return Result::success(
                'Session (' . $resultStartSession->session->identifier->value . ') started successfully.',
                $resultStartSession,
            );
        } catch (\Exception $e) {
            return Result::error(message: 'Failed to start session: ' . $e->getMessage());
        }
    }
}
