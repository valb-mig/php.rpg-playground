<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\Factory\GameMasterFactory;
use Rpg\Domain\Entity\GameMaster;
use Symfony\Component\Uid\Uuid;
use Tests\TestCase;

final class GameMasterTest extends TestCase
{
    private GameMasterFactory $gameMasterFactory;
    
    public function setUp(): void
    {
        $this->gameMasterFactory = new GameMasterFactory();
    }

    #[Test]
    public function success_when_build_game_master()
    {
        $uuid = Uuid::v4()->toString();
        $gameMaster = $this->gameMasterFactory->build($uuid, 'Jhon Doe');

        $this->assertInstanceOf(GameMaster::class, $gameMaster);
        $this->assertEquals('Jhon Doe', $gameMaster->getName());
        $this->assertEquals($uuid, $gameMaster->getUUID());
    }

    #[Test]
    public function should_fail_when_build_game_master_with_invalid_uuid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->gameMasterFactory->build('', 'Jhon Doe');
    }
    
    #[Test]
    public function should_fail_when_build_game_master_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->gameMasterFactory->build(Uuid::v4()->toString(), '');
    }
}
