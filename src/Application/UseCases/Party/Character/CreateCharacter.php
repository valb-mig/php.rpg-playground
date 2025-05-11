<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Character;

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

    /**
     * Create Character
     * @param Character $character
     * @return Character
     */

    public function handle(Character $character): Character
    {
        return $this->characterRepository->create($character);
    }
}
