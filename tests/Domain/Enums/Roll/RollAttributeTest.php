<?php

declare(strict_types=1);

namespace RPGPlayground\Tests\Domain\ValueObjects\Roll;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\Enums\Roll\RollAttribute;

final class RollAttributeTest extends TestCase
{
    public function test_is_advantage(): void
    {
        $this->assertTrue(RollAttribute::Advantage->isAdvantage());
        $this->assertFalse(RollAttribute::Advantage->isDisadvantage());
    }

    public function test_is_disadvantage(): void
    {
        $this->assertFalse(RollAttribute::Disadvantage->isAdvantage());
        $this->assertTrue(RollAttribute::Disadvantage->isDisadvantage());
    }
}
