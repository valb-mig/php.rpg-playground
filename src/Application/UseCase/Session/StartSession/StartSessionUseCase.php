<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

use Eco\Error;
use Eco\Result;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionInput;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionOutput;
use RPGPlayground\Core\Utils\Identifier;
use RPGPlayground\Domain\Entities\Session;

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
