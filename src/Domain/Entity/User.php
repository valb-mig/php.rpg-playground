<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Symfony\Component\Uid\Uuid;

class User 
{
    public string $uuid;
    
    public function __construct(
        protected string $name
    ) {
        if(empty($name)) {
            throw new \InvalidArgumentException('Invalid name');
        }

        $this->uuid = Uuid::v4()->toString();
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