<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Contracts\Event;

use RPGKernel\Domain\Contracts\Event\RPGSessionEventContract;

interface RPGSessionEventHandlerContract
{
    public function handle(RPGSessionEventContract $event): void;
}
