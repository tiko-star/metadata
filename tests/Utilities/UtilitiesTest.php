<?php

declare(strict_types = 1);

namespace App\Tests\Utilities;

use PHPUnit\Framework\TestCase;
use function App\Utilities\is_assoc;

class UtilitiesTest extends TestCase
{
    public function test_is_assoc_WhenGivenAssociativeArray_ReturnsTrue() : void
    {
        $this->assertTrue(
            is_assoc(['foo' => 'bar', 'baz' => 'bat'])
        );
    }

    public function test_is_assoc_WhenGivenNormalArray_ReturnsFalse() : void
    {
        $this->assertFalse(
            is_assoc([1, 2, 'foo', 'bar'])
        );
    }

    public function test_is_assoc_WhenGivenComplexArray_ReturnsTrue() : void
    {
        $this->assertTrue(
            is_assoc([1, 2, 'foo', 'bar' => 'baz'])
        );
    }

    public function test_is_assoc_WhenGivenNestedArray_ReturnsFalse() : void
    {
        $this->assertFalse(
            is_assoc([1, 2, 'foo', ['bar' => 'baz']])
        );
    }
}
