<?php

declare(strict_types=1);

namespace RPGPlayground\Domain\Enums\Roll;

enum RollAttribute: string
{
    case Advantage = 'advantage';
    case Disadvantage = 'disadvantage';

    public function isAdvantage(): bool
    {
        return $this === self::Advantage;
    }

    public function isDisadvantage(): bool
    {
        return $this === self::Disadvantage;
    }
}
