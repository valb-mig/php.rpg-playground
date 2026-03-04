<?php

declare(strict_types=1);

namespace RPGPlayground\Infrastructure\EntryPoints\Console\Session;

use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionUseCase;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionUseCaseInput;
use RPGPlayground\Infrastructure\Handler\LogHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'session:start', description: 'Start a new session', usages: ['session:start'])]
final class StartSessionCommand extends Command
{
    #[\Override]
    protected function configure(): void
    {
        try {
            $this->addArgument('name', InputArgument::OPTIONAL, 'Session name');
        } catch (\Exception) {
            // Ignore exceptions during configuration to allow for graceful handling in interact()
        }
    }

    #[\Override]
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        try {
            $name = (string) $input->getArgument('name');

            if (!empty($name)) {
                return;
            }

            $io = new SymfonyStyle($input, $output);
            $input->setArgument('name', $io->ask('Enter session name'));
        } catch (\Exception) {
            // Ignore exceptions during interaction to allow for graceful handling in execute()
        }
    }

    // @mago-analyse-ignore-start
    #[\Override]
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        try {
            $name = (string) $input->getArgument('name');

            if (!empty($name)) {
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
            $name = (string) $input->getArgument('name');

            $useCase = new StartSessionUseCase();

            $resultStartSession = $useCase->run(new StartSessionUseCaseInput(name: $name));

            if ($resultStartSession->isError()) {
                $io->error($resultStartSession->getMessage());
                return Command::FAILURE;
            }

            $resultStartSession = $resultStartSession->getData();

            if (!$resultStartSession) {
                $io->error('An unexpected error occurred while starting the session.');
                return Command::FAILURE;
            }

            $io->definitionList(
                ['Identifier' => $resultStartSession->session->identifier->value],
                ['Name' => $resultStartSession->session->name],
                ['Created At' => $resultStartSession->session->createdAt->format('Y-m-d H:i:s')],
            );

            $io->block(
                messages: 'IDENTIFIER: ' . $resultStartSession->session->identifier->value,
                type: 'RESULT',
                style: 'fg=black;bg=green;options=bold',
                padding: true,
            );

            LogHandler::dispatch('info', 'Started session', [
                'session_id' => $resultStartSession->session->identifier->value,
            ]);
            return Command::SUCCESS;
        } catch (\InvalidArgumentException $e) {
            $io = new SymfonyStyle($input, $output);
            $io->error($e->getMessage());
            LogHandler::dispatch('error', 'Start session command', ['exception' => $e->getMessage()]);
            return Command::FAILURE;
        }
    }
}
