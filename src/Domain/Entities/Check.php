<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Entities;

use RPGKernel\Core\Handler\StrHandler;

final class Check
{
    private function __construct(
        public readonly string $title,
        public readonly int $threshold,
    ) {}

    /**
     * @param string $title
     * @param int $threshold
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function create(string $title, int $threshold): self
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title cannot be empty.');
        }

        $title = StrHandler::sanitize($title);

        if ($threshold < 0) {
            throw new \InvalidArgumentException('Threshold must be greater than or equal to 0.');
        }

        return new self($title, $threshold);
    }

    /**
     * @param int $roll
     * @return bool
     */
    public function isSuccess(int $roll): bool
    {
        return $roll >= $this->threshold;
    }

    /**
     * @param int $roll
     * @return bool
     */
    public function isFailure(int $roll): bool
    {
        return $roll < $this->threshold;
    }
}
