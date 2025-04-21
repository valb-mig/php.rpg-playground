<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\Item;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;

class FakeItemRepository implements ItemRepositoryContract
{
    public function create(Item $item): Item
    {
        // INFO: Mantaining the same UUID
        return $item;
    }

    public function find(): void
    {
        throw new \Exception('Not implemented');
    }

    public function update(): void
    {
        throw new \Exception('Not implemented');
    }

    public function delete(): void
    {
        throw new \Exception('Not implemented');
    }
}