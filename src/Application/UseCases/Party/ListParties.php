<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\Party;

use Rpg\Domain\Entity\Party;
use Rpg\Infrastructure\Contract\PartyRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;

class ListParties
{
    private PartyRepositoryContract $partyRepository;

    public function __construct()
    {
        $this->partyRepository = (new RepositoryFactory('party'))->set();
    }

    /**
     * List Parties
     * @return Party[]
     */

    public function handle(): array
    {
        return $this->partyRepository->list();
    }
}