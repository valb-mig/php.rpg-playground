<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Repository\Fake;

use Rpg\Domain\Entity\Factory\GameMasterFactory;
use Rpg\Infrastructure\Contract\GameMasterRepositoryContract;
use Rpg\Domain\Entity\GameMaster;
use Symfony\Component\Uid\Uuid;

class FakeGameMasterRepository implements GameMasterRepositoryContract
{
    private $gameMasterFactory;

    public function __construct()
    {
        $this->gameMasterFactory = new GameMasterFactory();
    }

    public function create(string $uuid, string $name): GameMaster
    {
        return $this->gameMasterFactory->build(Uuid::v4()->toString(), $name);
    }

    public function find(string $uuid): GameMaster
    {
        return new GameMaster($uuid, 'Jhon Doe');
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