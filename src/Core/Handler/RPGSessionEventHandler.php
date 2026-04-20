<?php

declare(strict_types=1);

namespace RPGKernel\Core\Handler;

use RPGKernel\Domain\Contracts\Event\RPGSessionEventContract;
use RPGKernel\Domain\Contracts\Event\RPGSessionEventHandlerContract;

final class RPGSessionEventHandler
{
    private static ?RPGSessionEventHandlerContract $handler = null;
    private static bool $booted = false;

    public static function boot(RPGSessionEventHandlerContract ...$handlers): void
    {
        self::$handler = new CompositeEventHandler($handlers);
        self::$booted = true;
    }

    public static function dispatch(RPGSessionEventContract $event): void
    {
        if (!self::$booted) {
            return;
        }

        self::$handler->handle($event);
    }

    public static function reset(): void
    {
        self::$handler = null;
        self::$booted = false;
    }
}

final class CompositeEventHandler implements RPGSessionEventHandlerContract
{
    public function __construct(
        private readonly array $handlers,
    ) {}

    public function handle(RPGSessionEventContract $event): void
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($event);
        }
    }
}

final class RPGNullEventHandler implements RPGSessionEventHandlerContract
{
    public function handle(RPGSessionEventContract $event): void {}
}
