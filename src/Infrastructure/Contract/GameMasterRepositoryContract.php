<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\GameMaster;

interface GameMasterRepositoryContract
{
    /**
     * Create Game Master
     * @param string $uuid
     * @param string $name
     * @return GameMaster
     */

    public function create(string $uuid, string $name): GameMaster;

    /**
     * Find Game Master
     * @param string $uuid
     * @return GameMaster
     */

    public function find(string $uuid): GameMaster;

    /**
     * Update Game Master
     * @return void
     */

    public function update(): void;

    /**
     * Delete Game Master
     * @return void
     */

    public function delete(): void;
}