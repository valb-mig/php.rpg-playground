<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\User;
use Rpg\Domain\ValueObject\UUIDv4;

interface UserRepositoryContract
{

    /**
     * List Users
     * @return User[]
     */

    public function list(): array;

    /**
     * Create User
     * @param User $user
     * @return User
     */

    public function create(User $user): User;

    /**
     * Find User
     * @param UUIDv4 $uuid
     * @return User
     */

    public function find(UUIDv4 $uuid): User;

    /**
     * Update User
     * @return User
     */

    public function update(User $user): User;

    /**
     * Delete User
     * @param User $user
     * @return void
     */

    public function delete(User $user): void;
}
