<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\User;

use Rpg\Domain\Entity\User;
use Rpg\Infrastructure\Contract\UserRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class ListUsers
{
    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->userRepository = (new RepositoryFactory('user'))->set();
    }

    /**
     * List Useres
     * @return User[]
     */

    public function handle(User $user): array
    {
        return $this->userRepository->list();
    }
}
