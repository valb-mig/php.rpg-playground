<?php

declare(strict_types=1);

namespace RPGPlayground\Infrastructure\Handler;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

final class LogHandler
{
    private static ?Logger $instance = null;

    /**
     * Bind a logger instance to the LogHandler.
     * @param Logger $logger The logger instance to bind
     * @return void
     */
    public static function bind(Logger $logger): void
    {
        self::$instance = $logger;
    }

    /**
     * Add a log handler to the logger instance.
     * @param StreamHandler $streamHandler The log handler to add
     * @return void
     */
    public static function stream(StreamHandler $streamHandler): void
    {
        self::$instance?->pushHandler($streamHandler);
    }

    /**
     * @param Level $level The log level (e.g., Level::Error, Level::Info)
     * @param string $message The log message
     * @param array<string, mixed> $context Additional context for the log entry
     */
    public static function dispatch(Level $level, string $message, array $context = []): void
    {
        try {
            self::$instance?->log($level, $message, $context);
        } catch (\Throwable $e) {
            // Handle logging errors gracefully, e.g., by writing to a fallback log file
            error_log('Logging error: ' . $e->getMessage());
        }
    }
}
