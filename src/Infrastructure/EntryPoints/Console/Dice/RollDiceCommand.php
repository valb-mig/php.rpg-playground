<?php
namespace RPGPlayground\Infrastructure\EntryPoints\Console\Dice;

use RPGPlayground\Application\UseCase\Dice\RollDice;
use RPGPlayground\Domain\Entities\Dice;
use Symfony\Component\Console\{
    Attribute\AsCommand,
    Command\Command
};
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'dice:roll', 
    description: 'Roll dice',
    usages: ['d20', '2d20+5']
)]
final class RollDiceCommand extends Command
{
    public function configure(): void
    {
        $this
            ->addArgument('dice_params', InputArgument::REQUIRED, 'Dice params');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $diceParams = $input->getArgument('dice_params');

        preg_match('/^(\d+)d(\d+)/', $diceParams, $baseMatches);
        preg_match_all('/[+\-\/x]\d+/', $diceParams, $modifierMatches);

        $multiplier = $baseMatches[1];
        $maximum    = $baseMatches[2];
        $modifiers  = $modifierMatches[0];

        $dice = new Dice(
            maximum: (int) $maximum
        );

        $rollage = (new RollDice())->run(
            $dice,
            $modifiers,
            $multiplier
        );

        if($rollage->isError()){
            $io->error($rollage->getMessage());
            return Command::FAILURE;
        }

        $io->definitionList(
            ['Entry' => $diceParams],
            ['Dices' => "{$multiplier}x d{$maximum}"],
            ['Modifiers' => count($modifiers) > 0 ? implode(' ', $modifiers) : 'None']
        );

        $io->block(
            messages: "TOTAL OF: " . $rollage->getData(),
            type: 'RESULT',
            style: 'fg=black;bg=green;options=bold',
            padding: true
        );

        return Command::SUCCESS;
    }
}