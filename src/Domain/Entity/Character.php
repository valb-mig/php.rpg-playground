<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Abstraction\User;
use Rpg\Domain\ValueObject\Life;

class Character
{
    public function __construct(
        protected User $user,
        protected string $name,
        protected Life $life
    )
    {}

    public function getUser(): User
    {
        return $this->user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLife(): Life
    {
        return $this->life;
    }
}  