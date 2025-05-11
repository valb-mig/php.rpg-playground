<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\User;

use Rpg\Domain\Entity\User;
use Rpg\Infrastructure\Contract\UserRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class DeleteUser
{
    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->userRepository = (new RepositoryFactory('user'))->set();
    }

    /**
     * Delete User
     * @param User $user
     * @return void
     */

    public function handle(User $user): void
    {
        $this->userRepository->delete($user);
    }
}
