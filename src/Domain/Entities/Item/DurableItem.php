<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Entities\Item;

use RPGPlayground\Domain\Entities\Item;
use RPGPlayground\Domain\ValueObjects\Durability;

final class DurableItem
{
    public function __construct(
        private Item $item,
        public Durability $durability,
    ) {}

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return Durability
     */
    public function getDurability(): Durability
    {
        return $this->durability;
    }

    /**
     * @param Item $item
     * @param Durability $durability
     * @return self
     */
    public static function fromItem(Item $item, Durability $durability): self
    {
        return new self($item, $durability);
    }
}
