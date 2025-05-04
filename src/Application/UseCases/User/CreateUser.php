<?php
declare(strict_types=1);

namespace Rpg\Application\UseCases\User;

use Rpg\Domain\Entity\User;
use Rpg\Infrastructure\Contract\UserRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class CreateUser
{
    private UserRepositoryContract $userRepository;

    public function __construct()
    {
        $this->userRepository = (new RepositoryFactory('user'))->set();
    }

    /**
     * Create User
     * @param User $user
     * @return User
     */

    public function handle(User $user): User
    {
        $user = $this->userRepository->create($user);
        return $user;
    }
}