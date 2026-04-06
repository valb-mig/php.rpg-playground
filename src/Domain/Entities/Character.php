<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Handler\StrHandler;
use RPGKernel\Domain\Entities\Inventory;
use RPGKernel\Domain\ValueObjects\Attributes;
use RPGKernel\Domain\ValueObjects\Character\Identity;
use RPGKernel\Domain\ValueObjects\Character\Statistics;

class Character
{
    private Inventory $inventory;

    /**
     * @param string $name
     * @param string $description
     * @param Identity $identity
     * @param Statistics $statistics
     * @param Attributes $attributes
     */
    private function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly Identity $identity,
        public readonly Statistics $statistics,
        public readonly Attributes $attributes,
    ) {}

    /**
     * @param string $name
     * @param string $description
     * @param Identity $identity
     * @param Statistics $statistics
     * @param Attributes $attributes
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function create(
        string $name,
        string $description,
        Identity $identity,
        Statistics $statistics,
        Attributes $attributes,
    ): self {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty.');
        }

        $name = StrHandler::sanitize($name);

        if (empty($description)) {
            throw new \InvalidArgumentException('Description cannot be empty.');
        }

        $description = StrHandler::sanitize($description);

        return new self($name, $description, $identity, $statistics, $attributes);
    }

    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }
}
