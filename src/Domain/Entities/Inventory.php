<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Entities\Item\InventoryItem;

class Inventory
{
    /**
     * @param InventoryItem[] $items
     * @param int $slots
     * @param float $maxWeight
     * @return void
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private array $items,
        private int $slots,
        private float $maxWeight,
    ) {
        if ($slots < 1) {
            throw new \InvalidArgumentException('Slots must be greater than 0');
        }

        if ($maxWeight < 0) {
            throw new \InvalidArgumentException('Max weight must be greater than or equal to 0');
        }

        $this->checkItemsWeight($items);
    }

    /**
     * @param InventoryItem[] $items
     * @return static
     * @throws \InvalidArgumentException
     */
    private function checkItemsWeight(array $items): void
    {
        $totalWeight = 0;

        foreach ($items as $item) {
            $totalWeight += $item->getItem()->getWeight();
        }

        if ($totalWeight > $this->maxWeight) {
            throw new \InvalidArgumentException('Total weight of items must be less than or equal to max weight');
        }
    }

    /**
     * @param InventoryItem $item
     * @return void
     * @throws \InvalidArgumentException
     */
    public function add(InventoryItem $item): void
    {
        if ($this->has($item->getItem()->getId())) {
            throw new \InvalidArgumentException('Item already exists in inventory');
        }

        if ((count($this->items) + $item->getQuantity()) > $this->slots) {
            throw new \InvalidArgumentException('Inventory is full');
        }

        // TODO: checks if the inventory will fit the items if the new item is added
        $this->checkItemsWeight([...$this->items, $item]);

        $this->items[$item->getItem()->getId()->value] = $item;
    }

    /**
     * @param Identifier $id
     * @return void
     */
    public function remove(Identifier $id): void
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException('Item not found in inventory');
        }

        unset($this->items[$id->value]);
    }

    /**
     * @param Identifier $id
     * @param int $quantity
     * @return self
     * @throws \InvalidArgumentException
     */
    public function drop(Identifier $id, int $quantity): self
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException('Item not found in inventory');
        }

        $item = $this->get($id);

        if ($item->getQuantity() == $quantity) {
            $this->remove($id);
            return $this;
        }

        if ($quantity > $item->getQuantity()) {
            throw new \InvalidArgumentException("Not enough quantity of {$item->getItem()->getName()} to drop");
        }

        $item->setQuantity($item->getQuantity() - $quantity);

        $this->items[$id->value] = $item;

        return $this;
    }

    /**
     * @param Identifier $id
     * @return InventoryItem
     * @throws \InvalidArgumentException
     */
    public function get(Identifier $id): InventoryItem
    {
        if (!$this->has($id)) {
            throw new \InvalidArgumentException('Item not found in inventory');
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
     * @return InventoryItem[]
     */
    public function show(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getSlots(): int
    {
        return $this->slots;
    }

    /**
     * @return float
     */
    public function getMaxWeight(): float
    {
        return $this->maxWeight;
    }

    /**
     * @param int $slots
     */
    public function setSlots(int $slots): void
    {
        $this->slots = $slots;
    }

    /**
     * @param float $maxWeight
     */
    public function setMaxWeight(float $maxWeight): void
    {
        $this->maxWeight = $maxWeight;
    }
}
