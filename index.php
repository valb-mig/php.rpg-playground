<?php
require __DIR__.'/vendor/autoload.php';

use RPGPlayground\Infrastructure\EntryPoints\Console\Dice\RollDiceCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->addCommands([
    // Dice
    new RollDiceCommand()
]);

$application->run();