<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party;

use Rpg\Domain\Entity\Party;
use Rpg\Infrastructure\Contract\PartyRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class UpdateParty
{
    private PartyRepositoryContract $partyRepository;

    public function __construct()
    {
        $this->partyRepository = (new RepositoryFactory('party'))->set();
    }

    /**
     * Update Party
     * @param Party $party
     * @return Party
     */

    public function handle(Party $party): Party
    {
        return $this->partyRepository->update($party);
    }
}