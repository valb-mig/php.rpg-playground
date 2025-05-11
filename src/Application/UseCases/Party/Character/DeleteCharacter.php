<?php
declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Character;

use Rpg\Domain\Entity\Character;
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class DeleteCharacter
{
    private CharacterRepositoryContract $characterRepository;

    public function __construct()
    {
        $this->characterRepository = (new RepositoryFactory('character'))->set();
    }

    /**
     * Delete Character
     * @param Character $character
     * @return void
     */

    public function handle(Character $character): void
    {
        $this->characterRepository->delete($character);
    }
}