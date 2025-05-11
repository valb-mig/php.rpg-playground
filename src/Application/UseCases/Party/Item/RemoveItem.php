<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Item;

use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class RemoveItem
{
    private ItemRepositoryContract $itemRepository;

    public function __construct()
    {
        $this->itemRepository = (new RepositoryFactory('item'))->set();
    }

    /**
     * Remove Item
     * @param UUIDv4 $uuid
     * @return void
     */

    public function handle(UUIDv4 $uuid): void
    {
        $this->itemRepository->delete($uuid);
    }
}
