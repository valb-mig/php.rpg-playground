<?php

declare(strict_types=1);

namespace RPGKernel\Core\Handler\SessionEventHandler;

use RPGKernel\Domain\Contracts\Event\RPGSessionEventContract;
use RPGKernel\Domain\Contracts\Event\RPGSessionEventHandlerContract;

class FileSessionEventHandler implements RPGSessionEventHandlerContract
{
    public function handle(RPGSessionEventContract $event): void
    {
        if (!is_dir("logs/{$event->sessionId()->value}")) {
            mkdir("logs/{$event->sessionId()->value}", 0755, true);
        }

        file_put_contents(
            "logs/{$event->sessionId()->value}/console.log",
            json_encode($event->payload()) . PHP_EOL,
            FILE_APPEND,
        );
    }
}
