<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

use Eco\Error;
use Eco\Result;
use RPGPlayground\Core\Handler\StrHandler;

final class StartSessionInput
{
    /**
     * @param string $name The name of the session to be started
     */
    private function __construct(
        public string $name,
    ) {}

    /** @return Result<self> */
    public static function create(string $name): Result
    {
        /** @var Result<self> */
        return Result::ok($name)->ensure([
            [fn($name) => !empty($name), Error::validation('name', 'Name cannot be empty')],
        ])->transform(fn($name): self => new self(StrHandler::sanitize($name)));
    }
}
