<?php

declare(strict_types=1);

namespace RPGKernel\Domain\Enums;

enum SessionStatus: string
{
    case CREATED = 'created';
    case STARTED = 'started';
    case PAUSED = 'paused';
    case ENDED = 'ended';
}
