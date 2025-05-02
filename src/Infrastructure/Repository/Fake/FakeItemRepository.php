<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\Item;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;

class FakeItemRepository implements ItemRepositoryContract
{
    public function create(Item $item): Item
    {
        return $item;
    }

    public function find(UUIDv4 $uuid): Item
    {
        return new Item(
            $uuid,
            'Sword',
            'A sword',
            10
        );
    }

    public function update(Item $item): Item
    {
        return $item;
    }

    public function delete(UUIDv4 $uuid): void
    {
        throw new \Exception('Not implemented');
    }
}