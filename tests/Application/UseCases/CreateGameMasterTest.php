<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Rpg\Application\UseCases\GameMaster\CreateGameMaster;
use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\Factory\GameMasterFactory;
use Symfony\Component\Uid\Uuid;
use Tests\TestCase;

final class CreateGameMasterTest extends TestCase
{
    private GameMasterFactory $gameMasterFactory;
    
    public function setUp(): void
    {
        $this->gameMasterFactory = new GameMasterFactory();
    }

    #[Test]
    public function success_when_create_game_master()
    {
        $this->expectOutputString('Game Master created: Jhon Doe');

        $uuid = Uuid::v4()->toString();

        $gameMaster = $this->gameMasterFactory->build(
            uuid: $uuid, 
            name: 'Jhon Doe'
        );

        (new CreateGameMaster())->handle($gameMaster);
    }
}
