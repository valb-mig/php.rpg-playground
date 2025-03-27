<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\GameMaster;

use Rpg\Domain\Entity\GameMaster;
use Rpg\Infrastructure\Contract\GameMasterRepositoryContract;
use Rpg\Infrastructure\Repository\Fake\FakeGameMasterRepository;
use Symfony\Component\Uid\Uuid;

class CreateGameMaster
{
    private GameMasterRepositoryContract $gameMasterRepository;

    public function __construct()
    {
        $this->gameMasterRepository = new FakeGameMasterRepository();
    }

    /**
     * Create Game Master
     * @param GameMaster $gameMaster
     * @return void
     */

    public function handle(GameMaster $gameMaster): void
    {
        $gameMaster = $this->gameMasterRepository->create(Uuid::v4()->toString(), 'Jhon Doe');
        echo "Game Master created: " . $gameMaster->getName();
    }
}
