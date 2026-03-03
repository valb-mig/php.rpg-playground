<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use RPGPlayground\Infrastructure\EntryPoints\Console\Dice\RollDiceCommand;
use RPGPlayground\Infrastructure\EntryPoints\Console\Session\StartSessionCommand;
use RPGPlayground\Infrastructure\Factory\LoggerFactory;
use Symfony\Component\Console\Application;

// Console MODE
$application = new Application();

$application->addCommands([
    // Dice
    new RollDiceCommand(LoggerFactory::createFileLogger()),
    // Session
    new StartSessionCommand(LoggerFactory::createFileLogger()),
]);

$application->run();
