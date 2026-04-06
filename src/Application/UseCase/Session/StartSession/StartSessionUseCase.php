<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\StartSession;

use Eco\Error;
use Eco\Result;
use RPGKernel\Application\UseCase\Session\StartSession\StartSessionInput;
use RPGKernel\Application\UseCase\Session\StartSession\StartSessionOutput;
use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Entities\Session;

final class StartSessionUseCase
{
    /**
     * @param StartSessionInput $input
     * @return Result<StartSessionOutput>
     */
    public static function handle(StartSessionInput $input): Result
    {
        return Result::ok(
            new StartSessionOutput(session: new Session(
                name: $input->name,
                identifier: Identifier::generate(),
                createdAt: new \DateTime(),
            )),
        );
    }
}
