<?php
declare(strict_types=1);

namespace Rpg\Application\UseCases\Character;

use Rpg\Domain\Entity\Character;
use Rpg\Domain\Entity\Item;
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Infrastructure\ValueObject\Repository;

class AddItemToCharacterInventory
{
    private CharacterRepositoryContract $characterRepository;

    public function __construct()
    {
        $this->characterRepository = (new Repository('character'))->set();
    }

    public function handle(Character $character, Item $item): Character
    {
        $character->getInventory()->addItem($item);
        $this->characterRepository->update($character);

        echo "Item added to character inventory: " . $item->getName();

        return $character;
    }
}