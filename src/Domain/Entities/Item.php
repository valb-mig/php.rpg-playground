<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Handler\StrHandler;
use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\ValueObjects\Attributes;

class Item
{
    /**
     * @param Identifier $id
     * @param string $name
     * @param string $description
     * @param float $weight
     * @param Attributes $attributes
     */
    public function __construct(
        private Identifier $id,
        private string $name,
        private string $description,
        private float $weight,
        private Attributes $attributes,
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        if (empty($description)) {
            throw new \InvalidArgumentException('Description cannot be empty');
        }

        $name = StrHandler::sanitize($name);
        $description = StrHandler::sanitize($description);

        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return Identifier
     */
    public function getId(): Identifier
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return Attributes
     */
    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }
}
