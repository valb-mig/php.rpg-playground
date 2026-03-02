<?php

declare(strict_types=1);

namespace Tests\Domain\Entities;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\Entities\Session;
use RPGPlayground\Domain\ValueObjects\Utils\Identifier;

class SessionTest extends TestCase
{
    #[Test]
    public function shouldSucceedWhenCreateSession(): void
    {
        $session = new Session(name: 'Test Session', identifier: Identifier::generate(), createdAt: new \DateTime());

        static::assertInstanceOf(Session::class, $session);
        static::assertSame('Test Session', $session->name);
        static::assertInstanceOf(Identifier::class, $session->identifier);
        static::assertInstanceOf(\DateTime::class, $session->createdAt);
    }

    #[Test]
    public function shouldFailWhenCreateSessionWithEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Session(name: '', identifier: Identifier::generate(), createdAt: new \DateTime());
    }
}
