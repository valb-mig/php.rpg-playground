<?php
declare(strict_types=1);

namespace Rpg\Domain\Trait;

use Rpg\Domain\Entity\Condition;

trait ConditionTrait
{
    protected Condition $condition;

    public function getCondition(): Condition
    {
        return $this->condition;
    }

    public function setCondition(Condition $condition): void
    {
        $this->condition = $condition;
    }
}