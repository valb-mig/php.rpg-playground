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

    public function __construct(
        public int $max
    ){}
    
    public function getItems()
    {
        return $this->items;
    }

    public function addItem(Item $item)
    {
        if(count($this->items) >= $this->max) {
            throw new \InvalidArgumentException('Inventory is full');
        }
        
        $this->items[$item->getUUID()] = $item;
    }

    public function removeItem(Item $item)
    {
        unset($this->items[$item->getUUID()]);
    }
}
