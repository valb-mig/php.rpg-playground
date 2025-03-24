<?php

declare(strict_types=1);

namespace Rpg\Domain\Abstraction;

abstract class User
{
    public function __construct(
        protected int $id,
        protected string $name
    ) {}
}