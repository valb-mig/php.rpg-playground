<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use RPGPlayground\Core\Utils\Error;
use RPGPlayground\Core\Utils\Result;

class CreateUserInput
{
    private function __construct(
        public readonly string $name,
    ) {}

    /**
     * @return Result<CreateUserInput>
     */
    public static function create(string $name): Result
    {
        $errors = [];

        if (empty(trim($name))) {
            $errors[] = Error::validation('name', 'O nome é obrigatório.');
        }

        if (strlen($name) < 3) {
            $errors[] = Error::validation('name', 'O nome deve ter ao menos 3 caracteres.');
        }

        if (!empty($errors)) {
            return Result::fail(...$errors);
        }

        return Result::ok(new self($name));
    }
}

class CreateUser
{
    public function execute(CreateUserInput $input): Result
    {
        $user = new User(id: 1, name: $input->name);
        return Result::ok(new CreateUserOutput(id: $user->id, name: $user->name));
    }
}

class CreateUserOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}
}

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}
}
