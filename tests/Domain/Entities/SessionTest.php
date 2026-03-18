<?php

declare(strict_types=1);

namespace Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Core\Utils\Identifier;
use RPGPlayground\Domain\Entities\Session;

final class SessionTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_session_is_created_with_valid_data(): void
    {
        $session = $this->makeSession('My Campaign');

        $this->assertSame('My Campaign', $session->name);
    }

    public function test_session_identifier_is_stored(): void
    {
        $identifier = Identifier::generate();
        $session = new Session('My Campaign', $identifier, new \DateTime());

        $this->assertSame($identifier->value, $session->identifier->value);
    }

    public function test_session_created_at_is_stored(): void
    {
        $date = new \DateTime('2024-01-01');
        $session = new Session('My Campaign', Identifier::generate(), $date);

        $this->assertSame($date, $session->createdAt);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function makeSession(string $name): Session
    {
        return new Session($name, Identifier::generate(), new \DateTime());
    }
}
