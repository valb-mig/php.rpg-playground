<?php

declare(strict_types=1);

namespace Tests\Application\UseCases;

use Rpg\Application\UseCases\Item\CreateItem;
use PHPUnit\Framework\Attributes\Test;
use Rpg\Domain\Entity\Item;
use Tests\TestCase;

final class CreateItemTest extends TestCase
{
    #[Test]
    public function success_when_create_item()
    {
        $itemName = 'Sword';

        $this->expectOutputString('Item created: ' . $itemName);

        $item = new Item(
            name: $itemName,
            description: 'A sword',
            weight: 10
        );

        (new CreateItem())->handle($item);
    }

    #[Test]
    public function should_fail_when_create_item_with_invalid_name()
    {
        $this->expectException(\InvalidArgumentException::class);

        $itemName = '';

        $item = new Item(
            name: $itemName,
            description: 'A sword',
            weight: 10
        );

        (new CreateItem())->handle($item);
    }
}