<?php

declare(strict_types=1);

namespace Rpg\Domain\Enum;

enum ConditionStatus: string
{
    case ACTIVE  = 'ACTIVE';
    case PASSIVE = 'PASSIVE';
    case BOTH    = 'BOTH';
}
