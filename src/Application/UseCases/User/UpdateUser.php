<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\User;

use Rpg\Domain\Entity\User;
use Rpg\Infrastructure\Contract\UserRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class UpdateUser
{
    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->userRepository = (new RepositoryFactory('user'))->set();
    }

    /**
     * Update User
     * @param User $user
     * @return User
     */

    public function handle(User $user): User
    {
        return $this->userRepository->update($user);
    }
}