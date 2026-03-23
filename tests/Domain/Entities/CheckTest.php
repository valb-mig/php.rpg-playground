<?php

declare(strict_types=1);

namespace Tests\Domain\Entities;

use PHPUnit\Framework\TestCase;
use RPGPlayground\Domain\Entities\Check;

final class CheckTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Happy path
    // -------------------------------------------------------------------------

    public function test_check_is_created_with_valid_data(): void
    {
        $check = Check::create('My Check', 10);

        $this->assertSame('My Check', $check->title);
        $this->assertSame(10, $check->threshold);
    }

    public function test_check_is_successful_when_roll_is_greater_than_or_equal_to_threshold(): void
    {
        $check = Check::create('My Check', 10);

        $this->assertTrue($check->isSuccess(10));
        $this->assertFalse($check->isSuccess(9));
    }

    public function test_check_is_failure_when_roll_is_less_than_threshold(): void
    {
        $check = Check::create('My Check', 10);

        $this->assertFalse($check->isFailure(10));
        $this->assertTrue($check->isFailure(9));
    }

    // -------------------------------------------------------------------------
    // Exceptions
    // -------------------------------------------------------------------------

    public function test_check_throws_exception_when_threshold_is_negative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Threshold must be greater than or equal to 0.');

        Check::create('My Check', -1);
    }

    public function test_check_throws_exception_when_title_is_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Title cannot be empty.');

        Check::create('', 10);
    }
}
