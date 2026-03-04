<?php

declare(strict_types=1);

namespace RPGPlayground\Infrastructure\Handler;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

final class LogHandler
{
    private static ?Logger $instance = null;

    public static function bind(Logger $logger): void
    {
        self::$instance = $logger;
    }

    public static function stream(StreamHandler $streamHandler): void
    {
        self::$instance?->pushHandler($streamHandler);
    }

    public static function dispatch(string $level, string $message, array $context = []): void
    {
        self::$instance?->log($level, $message, $context);
    }
}
