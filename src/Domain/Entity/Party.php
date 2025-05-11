<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use Rpg\Domain\ValueObject\UUIDv4;

final class Party
{
    /** @var Condition[] */
    private array $conditions;
    /** @var Character[] */
    private array $characters;
    /** @var Item[] */
    private array $items;

    public function __construct(
        private UUIDv4 $uuid,
        private string $name,
        private array $attributes,
        array $conditions
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Invalid name');
        }

        $this->name = $name;
        
        /** @var Attribute[] $attributes */
        if (empty($attributes)) {
            throw new \InvalidArgumentException('Invalid attributes');
        }

        $this->attributes = $attributes;

        if (empty($conditions)) {
            throw new \InvalidArgumentException('Invalid conditions');
        }

        $this->conditions = $conditions;
    }

    /**
     * @param UUIDv4 $uuid
     */

    public function getUUID(): UUIDv4
    {
        return $this->uuid;
    }

    /**
     * @param string $name
     */

    public function getName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Attribute[]
     */

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return Condition[]
     */

    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @return Character[]
     */

    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * @param Character[] $characters
     */

    public function setCharacters(array $characters): void
    {
        $this->characters = $characters;
    }

    /**
     * @return Item[]
     */

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     */

    public function setItems(array $items): void
    {
        $this->items = $items;
    }
}
