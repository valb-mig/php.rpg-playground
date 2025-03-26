<?php

declare(strict_types=1);

namespace Rpg\Domain\Abstraction;

use Symfony\Component\Uid\Uuid;

abstract class User 
{
    public function __construct(
        protected Uuid $uuid,
        protected string $name
    ) {}

    public function getUUID(): Uuid
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}