<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party\Character;

use Rpg\Domain\Entity\Character;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class FindCharacter
{
    private CharacterRepositoryContract $characterRepository;

    public function __construct()
    {
        $this->characterRepository = (new RepositoryFactory('character'))->set();
    }

    /**
     * Find Character
     * @param UUIDv4 $uuid
     * @return Character
     */

    public function handle(UUIDv4 $uuid): Character
    {
        return $this->characterRepository->find($uuid);
    }
}