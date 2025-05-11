<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\Character;
use Rpg\Domain\ValueObject\UUIDv4;

interface CharacterRepositoryContract
{
    /**
     * Create Character
     * @param Character $character
     * @return Character
     */

    public function create(Character $character): Character;

    /**
     * Find Character
     * @param UUIDv4 $uuid
     * @return Character
     */

    public function find(UUIDv4 $uuid): Character;

    /**
     * Update Character
     * @param Character $character
     * @return Character
     */

    public function update(Character $character): Character;

    /**
     * Delete Character
     * @param Character $character
     * @return void
     */

    public function delete(Character $character): void;

    /**
     * List Characters
     * @return Character[]
     */

    public function list(): array;
}
