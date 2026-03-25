<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\ValueObjects\Character;

use RPGPlayground\Domain\ValueObjects\Bundle;

final class Identity extends Bundle
{
    /**
     * @param array<string, int|string|float|bool> $identityData
     */
    public function __construct(array $identityData = [])
    {
        parent::__construct($identityData);
    }
}
