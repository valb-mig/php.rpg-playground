<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Traits;

use RPGKernel\Core\Utils\Identifier;

trait SessionAware
{
    /**
     * @var Identifier|null
     */
    private ?Identifier $sessionId = null;

    /**
     * @param Identifier $sessionId
     * @return static
     */
    public function setSessionId(Identifier $sessionId): static
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * @return Identifier|null
     */
    public function getSessionId(): ?Identifier
    {
        return $this->sessionId;
    }

    /**
     * @return bool
     */
    public function hasSession(): bool
    {
        return $this->sessionId !== null;
    }
}
