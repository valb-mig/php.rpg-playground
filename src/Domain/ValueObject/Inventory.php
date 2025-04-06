<?php

declare(strict_types=1);

namespace Rpg\Domain\ValueObject;

use Rpg\Domain\Abstraction\Item;

class Inventory
{
    public function __construct(
        public int $max
    ){}
    
    public function getItems(Item $item)
    {
    }

    public function getItemById(string $uuid)
    {
    }

    public function addItem(Item $item)
    {
    }

    public function removeItem(Item $item)
    {
    }
}
