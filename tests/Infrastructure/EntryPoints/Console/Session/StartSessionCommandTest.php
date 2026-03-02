<?php

declare(strict_types=1);

namespace Tests\Infrastructure\EntryPoints\Console\Session;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Infrastructure\EntryPoints\Console\Session\StartSessionCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Tester\CommandTester;

final class StartSessionCommandTest extends TestCase
{
    private CommandTester $tester;

    protected function setUp(): void
    {
        $this->tester = new CommandTester(new StartSessionCommand());
    }

    public function testStartSessionSuccessfully(): void
    {
        $this->tester->execute(['name' => 'Test Session']);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('IDENTIFIER', $this->tester->getDisplay());
        static::assertStringContainsString('Name', $this->tester->getDisplay());
        static::assertStringContainsString('Created At', $this->tester->getDisplay());
    }

    public function testStartSessionWithoutNamePromptsForInput(): void
    {
        $this->tester->setInputs(['Test Session']);

        $this->tester->execute([]);

        $this->tester->assertCommandIsSuccessful();
        static::assertStringContainsString('Enter session name', $this->tester->getDisplay());
        static::assertStringContainsString('IDENTIFIER', $this->tester->getDisplay());
        static::assertStringContainsString('Name', $this->tester->getDisplay());
        static::assertStringContainsString('Created At', $this->tester->getDisplay());
    }
}
