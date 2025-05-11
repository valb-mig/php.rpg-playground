<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\User;

use Rpg\Domain\Entity\User;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\UserRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class FindUser
{
    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->userRepository = (new RepositoryFactory('user'))->set();
    }

    /**
     * Delete User
     * @param UUIDv4 $uuid
     * @return User
     */

    public function handle(UUIDv4 $uuid): User
    {
        return $this->userRepository->find($uuid);
    }
}
