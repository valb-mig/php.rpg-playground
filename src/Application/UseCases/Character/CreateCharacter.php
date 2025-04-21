<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Character;

use Rpg\Domain\Entity\Character;
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class CreateCharacter
{
    private CharacterRepositoryContract $characterRepository;

    public function __construct()
    {
        $this->characterRepository = (new RepositoryFactory('character'))->set();
    }

    public function handle(Character $character): Character
    {
        $character = $this->characterRepository->create(
            $character->getUser(),
            $character->getName(),
            $character->getLife()
        );
        
        echo "Character created: " . $character->getName();

        return $character;
    }
}
