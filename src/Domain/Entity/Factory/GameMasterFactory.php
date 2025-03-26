<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity\Factory;

use Rpg\Domain\Abstraction\User;
use Rpg\Domain\Contract\FactoryContract;
use Rpg\Domain\Entity\GameMaster;
use Symfony\Component\Uid\Uuid;

class GameMasterFactory implements FactoryContract
{
    public function create(Uuid $uuid, string $name): User
    {
        if(empty($uuid) || empty($name)) {
            throw new \InvalidArgumentException('Invalid arguments');
        }

        return new GameMaster($uuid, $name);
    }
}