<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Rpg\Application\UseCases\GameMaster\CreateGameMaster;
use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\GameMaster;
use Tests\TestCase;

final class CreateGameMasterTest extends TestCase
{
    #[Test]
    public function success_when_create_game_master()
    {
        $name = 'Jhon Doe';

        $this->expectOutputString('Game Master created: ' . $name);

        $gameMaster = new GameMaster($name);

        (new CreateGameMaster())->handle($gameMaster);
    }
}
