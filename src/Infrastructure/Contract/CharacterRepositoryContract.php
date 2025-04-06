<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\{
    User,
    Character
};
use Rpg\Domain\ValueObject\Life;

interface CharacterRepositoryContract
{
    /**
     * Create Character
     * @param User $user
     * @param string $name
     * @param Life $life
     * @return Character
     */

    public function create(User $user, string $name, Life $life): Character;

    /**
     * Find Character
     * @param string $uuid
     * @return Character
     */

    public function find(string $uuid): Character;

    /**
     * Update Character
     * @return void
     */

    public function update(): void;

    /**
     * Delete Character
     * @return void
     */

    public function delete(): void;
}