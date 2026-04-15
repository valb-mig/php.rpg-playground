<?php

declare(strict_types=1);

namespace RPGKernel\Application\UseCase\Session\CreateSession;

use Eco\Error;
use Eco\Result;

final class CreateSessionInput
{
    /**
     * @param string $name
     */
    private function __construct(
        public string $name,
    ) {}

    /** @return Result<self> */
    public static function create(string $name): Result
    {
        try {
            if (empty($name)) {
                return Result::fail(Error::validation('name', 'Name cannot be empty'));
            }

            return Result::ok(new self(name: $name));
        } catch (\Exception $e) {
            return Result::fail(Error::generic($e->getMessage()));
        }
    }
}
