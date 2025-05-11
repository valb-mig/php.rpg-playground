<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Item;

use Rpg\Domain\Entity\Item;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class CreateItem
{
    private ItemRepositoryContract $itemRepository;

    public function __construct()
    {
        $this->itemRepository = (new RepositoryFactory('item'))->set();
    }

    /**
     * Create Item
     * @param Item $item
     * @return Item
     */

    public function handle(Item $item): Item
    {
        $item = $this->itemRepository->create($item);
        return $item;
    }
}
