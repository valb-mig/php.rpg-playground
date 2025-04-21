<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\Condition;
use Rpg\Domain\Enum\ConditionStatus;
use Tests\TestCase;

class ConditionTest extends TestCase
{
    #[Test]
    public function success_when_build_condition()
    {
        $condition = new Condition(
            name: 'Damage',
            status: ConditionStatus::ACTIVE,
            value: 10
        );

        $this->assertEquals('Damage', $condition->getName());
        $this->assertEquals(ConditionStatus::ACTIVE, $condition->getStatus());
        $this->assertEquals(10, $condition->getValue());
    }

    #[Test]
    public function should_fail_when_build_condition_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        $condition = new Condition(
            name: '',
            status: ConditionStatus::ACTIVE,
            value: 10
        );
    }
}