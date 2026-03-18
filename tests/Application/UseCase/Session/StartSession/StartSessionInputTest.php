<?php

declare(strict_types=1);

namespace RPGPlayground\Tests\Application\UseCase\Session\StartSession;

use Error;
use PHPUnit\Framework\TestCase;
use RPGPlayground\Application\UseCase\Session\StartSession\StartSessionInput;

final class StartSessionInputTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_create_returns_ok_with_valid_name(): void
    {
        $result = StartSessionInput::create('My Campaign');

        $this->assertTrue($result->isOk());
    }

    public function test_input_name_is_stored_correctly(): void
    {
        $input = StartSessionInput::create('My Campaign')->unwrap();

        $this->assertSame('My Campaign', $input->name);
    }

    public function test_name_is_sanitized(): void
    {
        // StrHandler::sanitize should trim whitespace
        $input = StartSessionInput::create('  Trimmed Name  ')->unwrap();

        $this->assertSame('Trimmed Name', $input->name);
    }

    // -------------------------------------------------------------------------
    // Validation failures
    // -------------------------------------------------------------------------

    public function test_create_fails_with_empty_name(): void
    {
        $result = StartSessionInput::create('');

        $this->assertTrue($result->isFail());
    }

    public function test_error_has_validation_type_for_empty_name(): void
    {
        $result = StartSessionInput::create('');
        $error = $result->getErrors()[0];

        $this->assertSame('name', $error->field);
        $this->assertSame('Name cannot be empty', $error->message);
    }
}
