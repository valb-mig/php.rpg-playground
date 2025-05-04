<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\Item;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;

class FakeItemRepository implements ItemRepositoryContract
{
    /**
     * List Items
     * @return Item[]
     */

    public function list(): array
    {
        return [
            new Item(
                uuid: new UUIDv4('48777554-26d6-4b4d-8abb-111a3676b8de'),
                name: 'Sword',
                description: 'A sword',
                weight:10
            ),
            new Item(
                uuid: new UUIDv4('c1bee7a5-c47e-4179-b88e-6ec3e57d0ce5'),
                name: 'Shield',
                description: 'A shield',
                weight: 10
            )
        ];
    }

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
        return;
    }
}