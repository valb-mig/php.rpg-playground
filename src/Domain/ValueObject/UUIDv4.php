<?php

declare(strict_types=1);

namespace Rpg\Domain\ValueObject;

class UUIDv4
{
    public function __construct(
        protected string $uuid
    ) {
        $this->uuid = $this->validate($uuid);
    }

    /**
     * Get UUIDv4 value
     * @return string
     */

    public function getValue(): string
    {
        return $this->uuid;
    }

    /**
     * Validate UUIDv4
     * @param string $uuid
     * @return string
     */
    
    public static function validate(string $uuid): string
    {
        $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

        if (!preg_match($pattern, $uuid)) {
            throw new \InvalidArgumentException('invalid UUIDv4');
        }

        return $uuid;
    }
}