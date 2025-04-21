<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\GameMaster;

use Rpg\Domain\Entity\GameMaster;
use Rpg\Infrastructure\Contract\GameMasterRepositoryContract;
use Rpg\Infrastructure\Factory\RepositoryFactory;
use Symfony\Component\Uid\Uuid;

class CreateGameMaster
{
    private GameMasterRepositoryContract $gameMasterRepository;

    public function __construct()
    {
        $this->gameMasterRepository = (new RepositoryFactory('game_master'))->set();
    }

    public function handle(GameMaster $gameMaster): GameMaster
    {
        $gameMaster = $this->gameMasterRepository->create(Uuid::v4()->toString(), 'Jhon Doe');
        echo "Game Master created: " . $gameMaster->getName();

        return $gameMaster;
    }
}
