<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Domain\ValueObject\Life;
use Rpg\Domain\ValueObject\UUIDv4;

class FakeCharacterRepository implements CharacterRepositoryContract
{
    public function create(Character $character): Character
    {
        return $character;
    }

    public function find(UUIDv4 $uuid): Character
    {
        $user = new User(
            new UUIDv4('fake-uuid'),
            'Jhon Doe'
        );
        
        return new Character(
            $user,
            $uuid,
            'Vecna the Sorcerer',
            new Life(100, 100)
        );
    }

    public function update(Character $character): Character
    {   
        return $character;
    }

    public function delete(UUIDv4 $uuid): void
    {
        throw new \Exception('Not implemented');
    }
}