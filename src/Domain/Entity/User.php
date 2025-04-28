<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

class User 
{
    public function __construct(
        protected string $uuid,
        protected string $name
    ) {
        if(empty($name)) {
            throw new \InvalidArgumentException('Invalid name');
        }

        if(empty($uuid)) {
            throw new \InvalidArgumentException('Invalid uuid');
        }
    }

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}