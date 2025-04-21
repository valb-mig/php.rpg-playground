<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\Item;

interface ItemRepositoryContract
{
    /**
     * Create Item
     * @param Item $item
     * @return Item
     */

    public function create(Item $item): Item;

    /**
     * Find Item
     * @return void
     */

    public function find(): void;

    /**
     * Update Item
     * @return void
     */

    public function update(): void;

    /**
     * Delete Item
     * @return void
     */

    public function delete(): void;
}