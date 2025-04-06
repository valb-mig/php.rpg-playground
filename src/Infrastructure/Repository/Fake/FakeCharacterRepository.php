<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Infrastructure\Contract\CharacterRepositoryContract;
use Rpg\Domain\ValueObject\Life;

class FakeCharacterRepository implements CharacterRepositoryContract
{
    public function create(User $user, string $name, Life $life): Character
    {
        return new Character($user, $name, $life);
    }

    public function find(string $uuid): Character
    {
        return new Character(
            new User('Jhon Doe'),
            'Vecna the Sorcerer',
            new Life(100, 100)
        );
    }

    public function update(): void
    {
        throw new \Exception('Not implemented');
    }

    public function delete(): void
    {
        throw new \Exception('Not implemented');
    }
}