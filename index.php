<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Rpg\Application\UseCases\Character\CreateCharacter;
use Rpg\Domain\Entity\{
    User,
    Character,
    Condition,
    Item
};
use Rpg\Domain\Enum\ConditionStatus;
use Rpg\Domain\ValueObject\Life;

$dotenv = Dotenv::createImmutable(__DIR__, null, true);
$dotenv->load();

$character = (new CreateCharacter())->handle(
    new Character(
        new User('Jhon Doe'),
        'Vecna the Sorcerer',
        new Life(100, 100)
    )
);

$sword = new Item(
    name: 'Sword',
    description: 'A sword',
    weight: 10
);

$sword->setCondition(
    new Condition(
        name: 'Damage',
        status: ConditionStatus::ACTIVE,
        value: 10
    )
);

$healingPotion = new Item(
    name: 'Healing Potion',
    description: 'A healing potion',
    weight: 10
);

$healingPotion->setCondition(
    new Condition(
        name: 'Heal',
        status: ConditionStatus::BOTH,
        value: 10
    )
);

dd($character, $sword, $healingPotion);
