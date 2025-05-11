<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\Item;
use Rpg\Domain\ValueObject\UUIDv4;

interface ItemRepositoryContract
{
    /**
     * List Items
     * @return Item[]
     */

    public function list(): array;

    /**
     * Create Item
     * @param Item $item
     * @return Item
     */

    public function create(Item $item): Item;

    /**
     * Find Item
     * @param UUIDv4 $uuid
     * @return Item
     */

    public function find(UUIDv4 $uuid): Item;

    /**
     * Update Item
     * @param Item $item
     * @return Item
     */

    public function update(Item $item): Item;

    /**
     * Delete Item
     * @param UUIDv4 $uuid
     * @return void
     */

    public function delete(UUIDv4 $uuid): void;
}
