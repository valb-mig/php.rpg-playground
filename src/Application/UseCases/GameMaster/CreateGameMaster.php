<?php

declare(strict_types=1);

namespace Rpg\Application\UseCases\GameMaster;

use Rpg\Domain\Entity\GameMaster;

class CreateGameMaster
{
    /**
     * Create Game Master
     * @param GameMaster $gameMaster
     * @return void
     */

    public static function handle(GameMaster $gameMaster): void
    {
        echo "Game Master created: " . $gameMaster->getName();
    }
}
