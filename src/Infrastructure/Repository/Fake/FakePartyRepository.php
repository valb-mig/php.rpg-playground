<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\Party;
use Rpg\Domain\ValueObject\UUIDv4;
use Rpg\Infrastructure\Contract\PartyRepositoryContract;

class FakePartyRepository implements PartyRepositoryContract
{
    public function create(Party $party): Party
    {
        return $party;
    }

    public function find(UUIDv4 $uuid): Party
    {
        throw new \Exception('Not implemented');
    }

    public function update(Party $party): Party
    {
        throw new \Exception('Not implemented');
    }

    public function delete(Party $party): void
    {
        throw new \Exception('Not implemented');
    }

    public function list(): array
    {
        throw new \Exception('Not implemented');
    }
}
