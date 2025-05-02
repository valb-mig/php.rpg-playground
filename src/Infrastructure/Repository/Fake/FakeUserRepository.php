<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\User;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\UserRepositoryContract;

class FakeUserRepository implements UserRepositoryContract
{
    public function create(User $user): User
    {
        return $user;
    }

    public function find(UUIDv4 $uuid): User
    {
        return new User($uuid, 'Jhon Doe');
    }

    public function update(User $user): User
    {
        return $user;
    }

    public function delete(UUIDv4 $uuid): void
    {
        throw new \Exception('Not implemented');
    }
}