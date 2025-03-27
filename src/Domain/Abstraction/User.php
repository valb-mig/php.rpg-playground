<?php

declare(strict_types=1);

namespace Rpg\Domain\Abstraction;

abstract class User 
{
    public function __construct(
        protected string $uuid,
        protected string $name
    ) {}

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}