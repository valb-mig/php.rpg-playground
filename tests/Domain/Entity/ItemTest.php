<?php

declare(strict_types=1);

namespace Rpg\Domain\Entity;

use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\Item;
use Rpg\Domain\Enum\ConditionStatus;
use Tests\TestCase;

class ItemTest extends TestCase
{
    #[Test]
    public function success_when_build_item()
    {
        $item = new Item(
            name: 'Sword',
            description: 'A sword',
            weight: 10
        );

        $this->assertEquals('Sword', $item->getName());
        $this->assertEquals('A sword', $item->getDescription());
        $this->assertEquals(10, $item->getWeight());
        $this->assertEquals(false, $item->isWearable());
    }

    #[Test]
    public function success_when_build_item_with_condition()
    {
        $item = new Item(
            name: 'Sword',
            description: 'A sword',
            weight: 10
        );

        $item->setCondition(
            new Condition(
                name: 'Damage',
                status: ConditionStatus::ACTIVE,
                value: 10
            )
        );

        $this->assertInstanceOf(Condition::class, $item->getCondition());
        $this->assertEquals('Damage', $item->getCondition()->getName());
        $this->assertEquals(ConditionStatus::ACTIVE, $item->getCondition()->getStatus());
        $this->assertEquals(10, $item->getCondition()->getValue());
    }

    #[Test]
    public function should_fail_when_build_item_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        $item = new Item(
            name: '',
            description: 'A sword',
            weight: 10
        );
    }

    #[Test]
    public function should_fail_when_build_item_with_invalid_description()
    {
        $this->expectException(\InvalidArgumentException::class);

        $item = new Item(
            name: 'Sword',
            description: '',
            weight: 10
        );
    }

    #[Test]
    public function should_fail_when_build_item_with_invalid_weight()
    {
        $this->expectException(\InvalidArgumentException::class);

        $item = new Item(
            name: 'Sword',
            description: 'A sword',
            weight: -10
        );
    }
}