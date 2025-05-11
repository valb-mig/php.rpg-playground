<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party;

use Rpg\Domain\Entity\Party;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\PartyRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class FindParty
{
    private PartyRepositoryContract $partyRepository;

    public function __construct()
    {
        $this->partyRepository = (new RepositoryFactory('party'))->set();
    }

    /**
     * Find Party
     * @param UUIDv4 $uuid
     * @return Party
     */

    public function handle(UUIDv4 $uuid): Party
    {
        return $this->partyRepository->find($uuid);
    }
}