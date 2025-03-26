<?php

declare(strict_types=1);

namespace Rpg\Domain\Contract;

use Rpg\Domain\Abstraction\User;
use Symfony\Component\Uid\Uuid;

interface FactoryContract
{
    /**
     * Return a Entity
     * 
     * @param Uuid $uuid
     * @param string $name
     * @return User
     */

    public function create(Uuid $uuid, string $name): User;
}
