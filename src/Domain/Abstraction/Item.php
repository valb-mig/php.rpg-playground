<?php

declare(strict_types=1);

namespace Rpg\Domain\Abstraction;

use Symfony\Component\Uid\Uuid;

abstract class Item 
{
    public string $uuid;

    public function __construct(
        protected string $name,
        protected string $description,
        protected int    $weight = 0,
        protected bool   $wearable = false
    ) {
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

    public function isWearable(): bool
    {
        return $this->wearable;
    }
}