<?php

declare(strict_types=1);

namespace RPGKernel\Core\Handler;

class StrHandler
{
    public static function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value));
    }
}
