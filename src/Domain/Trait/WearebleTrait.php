<?php

declare(strict_types=1);

namespace Rpg\Domain\Trait;

trait WearebleTrait
{
    protected bool $wearable = false;

    public function isWearable(): bool
    {
        return $this->wearable;
    }

    public function setWearable(bool $wearable): self
    {
        $this->wearable = $wearable;
        return $this;
    }
}
