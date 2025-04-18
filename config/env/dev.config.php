<?php

declare(strict_types=1);

return [
    'repository' => [
        'game_master' => Rpg\Infrastructure\Repository\Fake\FakeGameMasterRepository::class,
        'character' => Rpg\Infrastructure\Repository\Fake\FakeCharacterRepository::class
    ]
];