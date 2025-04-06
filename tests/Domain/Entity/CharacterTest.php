<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Domain\ValueObject\Life;
use Tests\TestCase;

final class CharacterTest extends TestCase
{
    #[Test]
    public function success_when_build_character()
    {
        $characterName = 'Dwarf';

        $character = new Character(
            new User('Jhon Doe'),
            $characterName = 'Dwarf',
            new Life(100, 100)
        );

        $this->assertInstanceOf(Character::class, $character);
        $this->assertInstanceOf(User::class, $character->getUser());
        $this->assertEquals($characterName, $character->getName());
        $this->assertEquals(100, $character->getLife()->getCurrent());
        $this->assertEquals(100, $character->getLife()->getMax());
    }

    #[Test]
    public function should_fail_when_build_character_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        $characterName = '';

        (new Character(
            new User('Jhon Doe'),
            $characterName,
            new Life(100, 100)
        ));
    }

    #[Test]
    public function should_fail_when_build_character_with_invalid_life()
    {
        $this->expectException(\InvalidArgumentException::class);

        $characterName = 'Dwarf';

        (new Character(
            new User('Jhon Doe'),
            $characterName,
            new Life(100, 0)
        ));
    }

    #[Test]
    public function should_fail_when_build_character_with_invalid_user()
    {
        $this->expectException(\InvalidArgumentException::class);

        $characterName = 'Dwarf';

        (new Character(
            new User(''),
            $characterName,
            new Life(100, 100)
        ));
    }
}
