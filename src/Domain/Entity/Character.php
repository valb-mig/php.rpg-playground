<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Entity\User;
use Rpg\Domain\ValueObject\{
    Inventory,
    Life
};

class Character
{
    protected Inventory $inventory;

    public function __construct(
        protected User $user,
        protected string $name,
        protected Life $life
    ){
        if(empty($name)) {
            throw new \InvalidArgumentException('Invalid character name');
        }

        $this->inventory = new Inventory(0);
    }

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

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }
}  