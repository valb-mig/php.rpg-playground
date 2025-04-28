<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\User;

interface UserRepositoryContract
{
    /**
     * Create User
     * @param User $user
     * @return User
     */

    public function create(User $user): User;

    /**
     * Find User
     * @param string $uuid
     * @return User
     */

    public function find(string $uuid): User;

    /**
     * Update User
     * @return User
     */

    public function update(User $user): User;

    /**
     * Delete User
     * @param string $uuid
     * @return void
     */

    public function delete(string $uuid): void;
}