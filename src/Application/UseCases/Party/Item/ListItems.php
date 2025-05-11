<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Item;

use Rpg\Domain\Entity\Item;
use Rpg\Infrastructure\Contract\ItemRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class ListItems
{
    private ItemRepositoryContract $itemRepository;

    public function __construct()
    {
        $this->itemRepository = (new RepositoryFactory('item'))->set();
    }

    /**
     * List Items
     * @return Item[]
     */

    public function handle(): array
    {
        return $this->itemRepository->list();
    }
}
