<?php

declare(strict_types=1);

namespace RPGPlayground\Core\Handler;

class StrHandler
{
    public static function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value));
    }
}
