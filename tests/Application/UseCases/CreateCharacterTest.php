<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Application\UseCases\Character\CreateCharacter;
use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Domain\ValueObject\Life;
use Tests\TestCase;

final class CreateCharacterTest extends TestCase
{
    #[Test]
    public function success_when_create_character()
    {
        $characterName = 'Dwarf';

        $this->expectOutputString('Character created: ' . $characterName);

        $character = new Character(
            new User('Jhon Doe'),
            $characterName,
            new Life(100, 100)
        );

        (new CreateCharacter())->handle($character);
    }
}
