<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Contract;

use Rpg\Domain\Entity\Party;
use Rpg\Domain\ValueObject\UUIDv4;

interface PartyRepositoryContract
{
    /**
     * Create Party
     * @param Party $party
     * @return Party
     */

    public function create(Party $party): Party;

    /**
     * Find Party
     * @param UUIDv4 $uuid
     * @return Party
     */

     public function find(UUIDv4 $uuid): Party;

     /**
      * Update Party
      * @param Party $party
      * @return Party
      */

      public function update(Party $party): Party;

      /**
       * Delete Party
       * @param Party $party
       * @return void
       */

       public function delete(Party $party): void;

       /**
        * List Parties
        * @return Party[]
        */

        public function list(): array;
}
