<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use RPGPlayground\Infrastructure\EntryPoints\Console\Dice\RollDiceCommand;
use RPGPlayground\Infrastructure\EntryPoints\Console\Session\StartSessionCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->addCommands([
    // Dice
    new RollDiceCommand(),
    // Session
    new StartSessionCommand(),
]);

$application->run();
