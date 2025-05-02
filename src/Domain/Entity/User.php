<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\ValueObject\UUIDv4;

class User 
{
    public function __construct(
        protected UUIDv4 $uuid,
        protected string $name
    ) {
        if(empty($name)) {
            throw new \InvalidArgumentException('Invalid name');
        }

        if(empty($uuid)) {
            throw new \InvalidArgumentException('Invalid uuid');
        }
    }

    public function getUUID(): UUIDv4
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}