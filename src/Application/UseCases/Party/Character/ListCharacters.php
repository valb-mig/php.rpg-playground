<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Character;

use Rpg\Domain\Entity\Character;
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class ListCharacters
{
    private CharacterRepositoryContract $characterRepository;

    public function __construct()
    {
        $this->characterRepository = (new RepositoryFactory('character'))->set();
    }

    /**
     * List Characters
     * @return Character[]
     */

    public function handle(): array
    {
        return $this->characterRepository->list();
    }
}