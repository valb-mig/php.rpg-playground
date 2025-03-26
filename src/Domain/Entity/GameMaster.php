<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Abstraction\User;
use Symfony\Component\Uid\Uuid;

class GameMaster extends User
{
    public function __construct(Uuid $uuid, string $name)
    {
        parent::__construct($uuid, $name);
    }
}  