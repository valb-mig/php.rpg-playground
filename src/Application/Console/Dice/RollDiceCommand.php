<?php
namespace RPGPlayground\Application\Console\Dice;

use Symfony\Component\Console\{
    Attribute\AsCommand,
    Command\Command
};

#[AsCommand(name: 'app:dice:roll', description: 'Roll dice')]
class RollDiceCommand
{
    public function __invoke(): int
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}