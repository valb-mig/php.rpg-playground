<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\User;
use Rpg\Infrastructure\Contract\UserRepositoryContract;

class FakeUserRepository implements UserRepositoryContract
{
    public function create(User $user): User
    {
        return $user;
    }

    public function find(string $uuid): User
    {
        return new User($uuid, 'Jhon Doe');
    }

    public function update(User $user): User
    {
        return $user;
    }

    public function delete(string $uuid): void
    {
        throw new \Exception('Not implemented');
    }
}