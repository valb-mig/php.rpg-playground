<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Rpg\Application\UseCases\Character\CreateCharacter;
use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Domain\ValueObject\Life;

$dotenv = Dotenv::createImmutable(__DIR__, null, true);
$dotenv->load();

// Creating vecna :)

$character = (new CreateCharacter())->handle(
    new Character(
        new User('Jhon Doe'),
        'Vecna the Sorcerer',
        new Life(100, 100)
    )
);

dd($character);
