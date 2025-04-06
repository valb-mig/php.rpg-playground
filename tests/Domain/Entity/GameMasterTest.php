<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\GameMaster;
use Tests\TestCase;

final class GameMasterTest extends TestCase
{
    #[Test]
    public function success_when_build_game_master()
    {
        $name = 'Jhon Doe';

        $gameMaster = new GameMaster(
            name: $name
        );

        $this->assertInstanceOf(GameMaster::class, $gameMaster);
        $this->assertEquals('Jhon Doe', $gameMaster->getName());
    }

    #[Test]
    public function should_fail_when_build_game_master_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        $name = '';

        (new GameMaster($name));
    }
}
