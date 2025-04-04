<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Rpg\Application\UseCases\GameMaster\CreateGameMaster;
use Rpg\Domain\Entity\GameMaster;

$dotenv = Dotenv::createImmutable(__DIR__, null, true);
$dotenv->load();

$gameMaster = new GameMaster('uuid', 'Jhon Doe');
(new CreateGameMaster())->handle($gameMaster);
