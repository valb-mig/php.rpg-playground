<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Infrastructure\Contract\GameMasterRepositoryContract;
use Rpg\Domain\Entity\GameMaster;

class FakeGameMasterRepository implements GameMasterRepositoryContract
{
    public function create(string $uuid, string $name): GameMaster
    {
        return new GameMaster($name);
    }

    public function find(string $uuid): GameMaster
    {
        return new GameMaster('Jhon Doe');
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