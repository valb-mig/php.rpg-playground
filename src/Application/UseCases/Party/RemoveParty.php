<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party;

use Rpg\Domain\Entity\Party;
use Rpg\Infrastructure\Contract\PartyRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class RemoveParty
{
    private PartyRepositoryContract $partyRepository;

    public function __construct()
    {
        $this->partyRepository = (new RepositoryFactory('party'))->set();
    }

    /**
     * Remove Party
     * @param Party $party
     * @return void
     */

    public function handle(Party $party): void
    {
        $this->partyRepository->delete($party);
    }
}