<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Contracts\Identifier;

use RPGKernel\Core\Utils\Identifier;

interface HasIdentifierContract
{
    /**
     * @return Identifier
     */
    public function getIdentifier(): Identifier;

    /**
     * @return string
     */
    public function getIdentifierValue(): string;
}
