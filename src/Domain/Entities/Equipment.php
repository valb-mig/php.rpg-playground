<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Utils\Identifier;

class Equipment
{
    /**
     * @param Item[] $items
     * @return void
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private array $items,
    ) {}

    /**
     * @param Item $item
     * @return void
     * @throws \InvalidArgumentException
     */
    public function equip(Item $item): void
    {
        if ($this->has($item->getIdentifier())) {
            throw new \InvalidArgumentException('Item already exists in equipment');
        }

        $this->items[$item->getIdentifierValue()] = $item;
    }

    /**
     * @param Identifier $id
     * @return void
     */
    public function unequip(Identifier $id): void
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException('Item not found in equipment');
        }

        unset($this->items[$id->value]);
    }

    /**
     * @param Identifier $id
     * @return Item
     * @throws \InvalidArgumentException
     */
    public function get(Identifier $id): Item
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException('Item not found in equipment');
        }

        return $this->items[$id->value];
    }

    /**
     * @param Identifier $id
     * @return bool
     */
    public function has(Identifier $id): bool
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Id cannot be empty');
        }

        return array_key_exists($id->value, $this->items);
    }

    /**
     * @return Item[]
     */
    public function show(): array
    {
        return $this->items;
    }
}
