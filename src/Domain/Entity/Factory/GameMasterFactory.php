<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity\Factory;

use Rpg\Domain\Abstraction\User;
use Rpg\Domain\Entity\GameMaster;

class GameMasterFactory
{
    /**
     * Returns a Game Master Entity
     * 
     * @param string $uuid
     * @param string $name
     * @return User
     */

    public function build(string $uuid, string $name): User
    {
        if(empty($uuid)) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        if(empty($name)) {
            throw new \InvalidArgumentException('Invalid Name');
        }

        return new GameMaster($uuid, $name);
    }
}