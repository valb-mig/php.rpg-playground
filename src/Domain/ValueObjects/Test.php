<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects;

use RPGPlayground\Domain\Entities\Session;

class Test
{
    public function __construct(
        public readonly Session $session,
        public readonly string $title,
        public readonly int $dt,
    ) {
        if (empty($title)) {
            throw new \Exception('Title is required');
        }

        if (empty($dt)) {
            throw new \Exception('DT is required');
        }

        if ($dt < 1) {
            throw new \Exception('Minimum DT is 1');
        }
    }
}
