<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\User;
use Tests\TestCase;

final class UserTest extends TestCase
{
    #[Test]
    public function success_when_build_user()
    {
        $name = 'Jhon Doe';
        $user = new User($name);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($name, $user->getName());
    }

    #[Test]
    public function should_fail_when_build_user_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);
        (new User(''));
    }
}
