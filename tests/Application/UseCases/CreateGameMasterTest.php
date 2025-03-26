<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Symfony\Component\Uid\Uuid;
use Rpg\Application\UseCases\GameMaster\CreateGameMaster;
use Rpg\Domain\Entity\Factory\GameMasterFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class CreateGameMasterTest extends TestCase
{
    #[Test]
    public function success_when_create_game_master()
    {
        $gm = (new GameMasterFactory())->create(Uuid::v4(), 'Jhon Doe');
        CreateGameMaster::handle($gm);
        $this->assertTrue(true);
    }

    #[Test]
    public function fail_when_create_game_master()
    {
        $this->expectException(\Throwable::class); // [TODO] Custom Exception
        $gm = (new GameMasterFactory())->create(Uuid::v4(), '');
        CreateGameMaster::handle($gm);
    }
}
