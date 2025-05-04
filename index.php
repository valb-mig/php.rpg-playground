<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Rpg\Application\UseCases\Character\CreateCharacter;
use Rpg\Application\UseCases\Item\{
    CreateItem,
    ListItems,
    RemoveItem
};
use Rpg\Application\UseCases\User\CreateUser;
use Rpg\Domain\Entity\{
    User,
    Character,
    Condition,
    Item
};
use Rpg\Domain\Enum\ConditionStatus;
use Rpg\Domain\ValueObject\Life;
use Rpg\Domain\ValueObject\UUIDv4;
use Symfony\Component\Uid\Uuid;

(Dotenv::createImmutable(__DIR__, null, true))->load();

$user = (new CreateUser())->handle(
    new User(
        new UUIDv4(Uuid::v4()->toString()),
        'Jhon Doe'
    )
);

$character = (new CreateCharacter())->handle(
    new Character(
        $user,
        new UUIDv4(Uuid::v4()->toString()),
        'Vecna the Sorcerer',
        new Life(100, 100)
    )
);

$sword = (new CreateItem())->handle(
    new Item(
        new UUIDv4(Uuid::v4()->toString()),
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

$shield = (new CreateItem())->handle(
    new Item(
        new UUIDv4(Uuid::v4()->toString()),
        name: 'Shield',
        description: 'A shield',
        weight: 10
    )
);

// [TODO] Update character inventory, how to persist information
$character->getInventory()->addItem($sword);
$character->getInventory()->addItem($shield);
$character->getInventory()->removeItem($sword->getUUID());

(new RemoveItem())->handle(new UUIDv4(Uuid::v4()->toString()));

dd((new ListItems())->handle());