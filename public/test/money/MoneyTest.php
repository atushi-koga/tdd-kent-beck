<?php
declare(strict_types=1);

namespace App\test\money;

use App\src\money\Dollar;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $this->assertEquals(
            new Dollar(10),
            (new Dollar(5))->times(2)
        );

        $this->assertEquals(
            new Dollar(15),
            (new Dollar(5))->times(3)
        );
    }

    public function testEqual()
    {
        $this->assertTrue(
            (new Dollar(5))->equal(new Dollar(5))
        );
        $this->assertFalse(
            (new Dollar(5))->equal(new Dollar(6))
        );
    }
}