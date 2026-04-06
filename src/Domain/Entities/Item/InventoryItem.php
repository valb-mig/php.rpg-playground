<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities\Item;

use RPGKernel\Domain\Entities\Item;

final class InventoryItem
{
    public function __construct(
        private Item $item,
        private int $quantity = 1,
    ) {
        if ($quantity < 1) {
            throw new \InvalidArgumentException('Quantity cannot be less than 1');
        }
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setQuantity(int $quantity): void
    {
        if ($quantity < 1) {
            throw new \InvalidArgumentException('Quantity cannot be less than 1');
        }
        $this->quantity = $quantity;
    }

    /**
     * @param Item $item
     * @param int $quantity
     * @return self
     */
    public static function fromItem(Item $item, int $quantity = 1): self
    {
        return new self($item, $quantity);
    }
}
