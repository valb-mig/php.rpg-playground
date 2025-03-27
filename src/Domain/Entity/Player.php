<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Abstraction\User;

class Player extends User
{
    public function __construct(string $uuid, string $name) {
        parent::__construct($uuid, $name);
    }
}  