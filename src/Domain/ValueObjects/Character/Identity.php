<?php

declare(strict_types=1);

namespace RPGKernel\Domain\ValueObjects\Character;

use RPGKernel\Domain\ValueObjects\Bundle;

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
