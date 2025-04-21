<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Enum\ConditionStatus as Status;

class Condition 
{
    public function __construct(
        protected string $name,
        protected Status $status,
        protected int $value
    ){
        if(empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}