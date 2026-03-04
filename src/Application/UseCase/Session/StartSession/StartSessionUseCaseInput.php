<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

final class StartSessionUseCaseInput
{
    /**
     * @param string $name The name of the session to be started
     * @throws \InvalidArgumentException if the name is empty
     */
    public function __construct(
        public string $name,
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $this->name = htmlspecialchars(trim($name));
    }
}
