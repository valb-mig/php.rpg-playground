<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Traits;

use RPGKernel\Core\Utils\Identifier;

trait IdentifierAware
{
    /**
     * @var Identifier
     */
    private Identifier $identifier;

    /**
     * @return Identifier
     */
    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getIdentifierValue(): string
    {
        return $this->identifier->value;
    }
}
