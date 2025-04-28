<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Rpg\Application\UseCases\Character\CreateCharacter;
use Rpg\Application\UseCases\Item\CreateItem;
use Rpg\Application\UseCases\User\CreateUser;
use Rpg\Domain\Entity\{
    User,
    Character,
    Condition,
    Item
};
use Rpg\Domain\Enum\ConditionStatus;
use Rpg\Domain\ValueObject\Life;
use Symfony\Component\Uid\Uuid;

(Dotenv::createImmutable(__DIR__, null, true))->load();

$user = (new CreateUser())->handle(
    new User(
        Uuid::v4()->toString(),
        'Jhon Doe'
    )
);

$character = (new CreateCharacter())->handle(
    new Character(
        $user,
        'Vecna the Sorcerer',
        new Life(100, 100)
    )
);

$sword = (new CreateItem())->handle(
    new Item(
        name: 'Sword',
        description: 'A sword',
        weight: 10
    )
);

$sword->setCondition(
    new Condition(
        name: 'Damage',
        status: ConditionStatus::ACTIVE,
        value: 10
    )
);

dd($character, $sword);
