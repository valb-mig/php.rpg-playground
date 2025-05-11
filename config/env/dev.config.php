<?php

declare(strict_types=1);

return [
    'repository' => [
        'character'   => Rpg\Infrastructure\Repository\Fake\FakeCharacterRepository::class,
        'item'        => Rpg\Infrastructure\Repository\Fake\FakeItemRepository::class,
        'user'        => Rpg\Infrastructure\Repository\Fake\FakeUserRepository::class,
        'party'       => Rpg\Infrastructure\Repository\Fake\FakePartyRepository::class
    ]
];