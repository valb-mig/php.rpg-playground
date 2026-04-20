<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Handler\StrHandler;
use RPGKernel\Core\Utils\Identifier;
use RPGKernel\Domain\Contracts\Identifier\HasIdentifierContract;
use RPGKernel\Domain\Enums\SessionStatus;
use RPGKernel\Domain\Traits\IdentifierAware;

final class Session implements HasIdentifierContract
{
    use IdentifierAware;

    private SessionStatus $sessionStatus;

    /**
     * @param string $name The name of the session
     * @param Identifier $identifier The unique identifier for the session
     * @param \DateTime $createdAt The date and time when the session was created
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private Identifier $identifier,
        private string $name,
        public readonly \DateTime $createdAt,
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }
        $this->name = StrHandler::sanitize($name);
        $this->sessionStatus = SessionStatus::CREATED;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return SessionStatus
     */
    public function getStatus(): SessionStatus
    {
        return $this->sessionStatus;
    }

    /**
     * @param SessionStatus $sessionStatus
     */
    public function setStatus(SessionStatus $sessionStatus): void
    {
        $this->sessionStatus = $sessionStatus;
    }
}
