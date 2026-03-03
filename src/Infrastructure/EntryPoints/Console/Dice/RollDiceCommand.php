<?php

declare(strict_types=1);

namespace RPGPlayground\Infrastructure\EntryPoints\Console\Dice;

use Monolog\Logger;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCase;
use RPGPlayground\Application\UseCase\Dice\RollDice\RollDiceUseCaseInput;
use RPGPlayground\Domain\ValueObjects\App\Dice;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'dice:roll', description: 'Roll dice', usages: ['d20', '2d20+5'])]
final class RollDiceCommand extends Command
{
    private const string DICE_PATTERN = '/^(\d*)d(\d+)/';
    private const string MODIFIER_PATTERN = '/[+\-\/x]\d+/';

    public function __construct(
        private Logger $logger,
    ) {
        parent::__construct();
    }

    #[\Override]
    protected function configure(): void
    {
        try {
            $this->addArgument('dice_params', InputArgument::OPTIONAL, 'Dice params (e.g., 2d20+5)');
        } catch (\Exception $e) {
            // Ignore exceptions during configuration to allow for graceful handling in interact()
        }
    }

    #[\Override]
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        try {
            $diceParams = (string) $input->getArgument('dice_params');

            if (!empty($diceParams)) {
                return;
            }

            $io = new SymfonyStyle($input, $output);
            $input->setArgument('dice_params', $io->ask('Enter dice parameters (e.g., 2d20+5)'));
        } catch (\Exception) {
            // Ignore exceptions during interaction to allow for graceful handling in execute()
        }
    }

    // @mago-analyse-ignore-start
    #[\Override]
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        try {
            $diceParams = (string) $input->getArgument('dice_params');

            if (!$diceParams) {
                return;
            }

            $baseMatches = [];

            if (!preg_match(self::DICE_PATTERN, $diceParams, $baseMatches)) {
                return;
            }

            $multiplier = (int) ($baseMatches[1] ?? 1);
            $sides = (int) (
                $baseMatches[2] ?? throw new \InvalidArgumentException(
                    'Invalid dice parameters. Expected format: [multiplier]d[max][modifiers]',
                )
            );

            if ($multiplier < 1) {
                return;
            }

            if ($sides < Dice::MINIMUM_VALUE) {
                return;
            }
        } catch (\Exception) {
            // Ignore exceptions during initialization to allow for interactive input
        }
    }

    // @mago-analyse-ignore-end
    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $io = new SymfonyStyle($input, $output);
            $diceParams = (string) $input->getArgument('dice_params');
            $baseMatches = [];
            $modifierMatches = [];

            preg_match(self::DICE_PATTERN, $diceParams, $baseMatches);
            preg_match_all(self::MODIFIER_PATTERN, $diceParams, $modifierMatches);

            $multiplier = (int) ($baseMatches[1] ?? 1);
            $sides = (int) (
                $baseMatches[2] ?? throw new \InvalidArgumentException(
                    'Invalid dice parameters. Expected format: [multiplier]d[max][modifiers]',
                )
            );
            $modifiers = $modifierMatches[0] ?? [];

            $useCase = new RollDiceUseCase();

            $resultRollValue = $useCase->run(new RollDiceUseCaseInput(
                dice: new Dice($sides),
                modifiers: $modifiers,
                multiplier: $multiplier,
            ));

            if ($resultRollValue->isError()) {
                $io->error($resultRollValue->getMessage());
                return Command::FAILURE;
            }

            $resultRollValue = $resultRollValue->getData();

            if (!$resultRollValue) {
                $io->error('An unexpected error occurred while rolling the dice.');
                return Command::FAILURE;
            }

            $io->definitionList(
                ['Entry' => $diceParams],
                ['Dices' => "{$multiplier}x d{$sides}"],
                ['Modifiers' => count($modifiers) > 0 ? implode(' ', $modifiers) : 'None'],
            );

            $io->block(
                messages: 'TOTAL: ' . $resultRollValue->rollValue,
                type: 'RESULT',
                style: 'fg=black;bg=green;options=bold',
                padding: true,
            );

            $this->logger->info('Rolled dice', ['roll_value' => $resultRollValue->rollValue]);

            return Command::SUCCESS;
        } catch (\InvalidArgumentException $e) {
            $io = new SymfonyStyle($input, $output);
            $io->error($e->getMessage());

            $this->logger->error('Invalid dice parameters: ' . $e->getMessage(), ['input' => $input->getArgument(
                'dice_params',
            )]);

            return Command::FAILURE;
        }
    }
}
