<?php

declare(strict_types=1);

namespace RPGPlayground\Infrastructure\Factory;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory
{
    public static function createFileLogger(): Logger
    {
        $logger = new Logger('file');
        $logger->pushHandler(new StreamHandler(dirname(__DIR__, 3) . '/logs/file/debug.log'));
        return $logger;
    }

    public static function createConsoleLogger(): Logger
    {
        $logger = new Logger('console');
        $logger->pushHandler(new StreamHandler('php://stdout'));
        return $logger;
    }
}
