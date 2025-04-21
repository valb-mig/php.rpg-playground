<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\Entity\Condition;
use Rpg\Domain\Trait\{
    WearebleTrait,
    ConditionTrait
};
use Symfony\Component\Uid\Uuid;

class Item 
{
    use WearebleTrait;
    use ConditionTrait;

    public string $uuid;
    protected Condition $condition;

    public function __construct(
        protected string $name,
        protected string $description,
        protected int    $weight = 0
    ) {
        if(empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        if(empty($description)) {
            throw new \InvalidArgumentException('Description cannot be empty');
        }

        if($weight < 0) {
            throw new \InvalidArgumentException('Weight cannot be negative');
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

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}