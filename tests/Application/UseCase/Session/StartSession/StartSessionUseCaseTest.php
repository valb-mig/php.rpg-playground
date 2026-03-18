<?php

declare(strict_types=1);

namespace Tests\Application\UseCase\Session\StartSession;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionInput;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionOutput;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionUseCase;
use RPGPlayground\Domain\Entities\Session;

final class StartSessionUseCaseTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_handle_returns_ok_result(): void
    {
        $input = $this->makeInput('My Campaign');
        $result = StartSessionUseCase::handle($input);

        $this->assertTrue($result->isOk());
    }

    public function test_handle_returns_start_session_output(): void
    {
        $input = $this->makeInput('My Campaign');
        $output = StartSessionUseCase::handle($input)->unwrap();

        $this->assertInstanceOf(StartSessionOutput::class, $output);
    }

    public function test_output_contains_session_entity(): void
    {
        $input = $this->makeInput('My Campaign');
        $output = StartSessionUseCase::handle($input)->unwrap();

        $this->assertInstanceOf(Session::class, $output->session);
    }

    public function test_session_name_matches_input(): void
    {
        $input = $this->makeInput('My Campaign');
        $output = StartSessionUseCase::handle($input)->unwrap();

        $this->assertSame('My Campaign', $output->session->name);
    }

    public function test_session_has_identifier(): void
    {
        $input = $this->makeInput('My Campaign');
        $output = StartSessionUseCase::handle($input)->unwrap();

        $this->assertNotEmpty($output->session->identifier->value);
    }

    public function test_each_session_gets_unique_identifier(): void
    {
        $input = $this->makeInput('My Campaign');

        $id1 = StartSessionUseCase::handle($input)
            ->unwrap()
            ->session
            ->identifier
            ->value;
        $id2 = StartSessionUseCase::handle($input)
            ->unwrap()
            ->session
            ->identifier
            ->value;

        $this->assertNotSame($id1, $id2);
    }

    public function test_session_created_at_is_set(): void
    {
        $before = new \DateTime();
        $output = StartSessionUseCase::handle($this->makeInput('My Campaign'))->unwrap();
        $after = new \DateTime();

        $this->assertGreaterThanOrEqual($before, $output->session->createdAt);
        $this->assertLessThanOrEqual($after, $output->session->createdAt);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function makeInput(string $name): StartSessionInput
    {
        return StartSessionInput::create($name)->unwrap();
    }
}
