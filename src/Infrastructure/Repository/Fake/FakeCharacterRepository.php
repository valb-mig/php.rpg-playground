<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\{
    User,
    Character,
    Party
};
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Domain\ValueObject\Life;
use Rpg\Domain\ValueObject\UUIDv4;

class FakeCharacterRepository implements CharacterRepositoryContract
{
    public function list(): array
    {
        throw new \Exception('Not implemented');
    }

    public function create(Character $character): Character
    {
        throw new \Exception('Not implemented');
    }

    public function find(UUIDv4 $uuid): Character
    {
        throw new \Exception('Not implemented');
    }

    public function delete(Character $character): void
    {
        throw new \Exception('Not implemented');
    }

    public function update(Character $character): Character
    {
        throw new \Exception('Not implemented');
    }
}
