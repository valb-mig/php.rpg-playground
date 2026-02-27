<?php
declare(strict_types=1);

namespace RPGPlayground\Infrastructure\EntryPoints\Console\Dice;

use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCaseInput;
use RPGPlayground\Domain\ValueObjects\App\Dice;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
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
    private const DICE_PATTERN = '/^(\d*)d(\d+)/';
    private const MODIFIER_PATTERN = '/[+\-\/x]\d+/';

    protected function configure(): void
    {
        $this->addArgument('dice_params', InputArgument::OPTIONAL, 'Dice params (e.g., 2d20+5)');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if ($input->getArgument('dice_params')) {
            return;
        }

        $io = new SymfonyStyle($input, $output);
        $input->setArgument(
            'dice_params',
            $io->ask('Enter dice parameters (e.g., 2d20+5)')
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $diceParams = $input->getArgument('dice_params');

        if (!$diceParams) {
            return;
        }

        if (!preg_match(self::DICE_PATTERN, $diceParams, $baseMatches)) {
            throw new \InvalidArgumentException(
                'Invalid dice parameters. Expected format: [multiplier]d[max][modifiers]'
            );
        }

        $multiplier = (int) ($baseMatches[1] ?: 1);
        $sides    = (int) $baseMatches[2];

        if ($multiplier < 1) {
            throw new \InvalidArgumentException('Multiplier must be at least 1');
        }

        if ($sides < Dice::MINIMUM_VALUE) {
            throw new \InvalidArgumentException('Dice sides must be at least ' . Dice::MINIMUM_VALUE);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io         = new SymfonyStyle($input, $output);
        $diceParams = $input->getArgument('dice_params');

        preg_match(self::DICE_PATTERN, $diceParams, $baseMatches);
        preg_match_all(self::MODIFIER_PATTERN, $diceParams, $modifierMatches);

        $multiplier = (int) ($baseMatches[1] ?: 1);
        $sides    = (int) $baseMatches[2];
        $modifiers  = $modifierMatches[0];

        $useCase = new RollDiceUseCase();

        $rollage = $useCase->run(new RollDiceUseCaseInput(
            dice: new Dice($sides),
            modifiers: $modifiers,
            multiplier: $multiplier
        ));

        if ($rollage->isError()) {
            $io->error($rollage->getMessage());
            return Command::FAILURE;
        }

        $io->definitionList(
            ['Entry'     => $diceParams],
            ['Dices'     => "{$multiplier}x d{$sides}"],
            ['Modifiers' => count($modifiers) > 0 ? implode(' ', $modifiers) : 'None']
        );

        $io->block(
            messages: 'TOTAL: ' . $rollage->getData()->rollage,
            type: 'RESULT',
            style: 'fg=black;bg=green;options=bold',
            padding: true
        );

        return Command::SUCCESS;
    }
}