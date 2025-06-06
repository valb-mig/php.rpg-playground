<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Entity\User;
use Rpg\Domain\ValueObject\{
    Inventory,
    Life,
    UUIDv4
};

class Character
{
    protected Inventory $inventory;

    public function __construct(
        protected User $user,
        protected UUIDv4 $uuid,
        protected Party $party,
        protected string $name,
        protected Life $life
    ) {
        if (empty($uuid)) {
            throw new \InvalidArgumentException('Invalid character uuid');
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('Invalid character name');
        }

        if (empty($party) || !($party instanceof Party)) {
            throw new \InvalidArgumentException('Invalid party');
        }

        $this->inventory = new Inventory(10);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUUID(): UUIDv4
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParty(): Party
    {
        return $this->party;
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
