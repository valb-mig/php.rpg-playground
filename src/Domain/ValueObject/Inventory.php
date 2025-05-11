<?php

declare(strict_types=1);

namespace Rpg\Domain\ValueObject;

use Rpg\Domain\Entity\Item;

class Inventory
{
    /**
     * @var Item[]
     */

    private array $items = [];
    private int $current = 0;

    public function __construct(
        public int $max
    ) {
        if (!is_numeric($max)) {
            throw new \InvalidArgumentException('Max must be numeric');
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    public function addItem(Item $item)
    {
        if (count($this->items) >= $this->max) {
            throw new \InvalidArgumentException('Inventory is full');
        }

        $this->items[$item->getUUID()->getValue()] = $item;
        $this->current = count($this->items);
    }

    public function removeItem(UUIDv4 $uuid)
    {
        unset($this->items[$uuid->getValue()]);
        $this->current = count($this->items);
    }
}
