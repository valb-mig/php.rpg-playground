<?php

declare(strict_types=1);

namespace RPGPlayground\Application\UseCase\Session\StartSession;

final class StartSessionUseCaseInput
{
    public function __construct(
        public string $name,
    ) {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $this->name = htmlspecialchars(trim($name));
    }
}
