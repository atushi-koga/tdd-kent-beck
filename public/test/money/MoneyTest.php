<?php
declare(strict_types=1);

namespace App\test\money;

use App\src\money\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $fiveDollar = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $fiveDollar->times(2));
        $this->assertEquals(Money::dollar(15), $fiveDollar->times(3));
        $fiveFranc = Money::franc(5);
        $this->assertEquals(Money::franc(10), $fiveFranc->times(2));
        $this->assertEquals(Money::franc(15), $fiveFranc->times(3));

    }

    public function testEquality()
    {
        $this->assertTrue(
            Money::dollar(5)->equal(Money::dollar(5))
        );
        $this->assertFalse(
            Money::dollar(5)->equal(Money::dollar(6))
        );
        $this->assertTrue(
            Money::franc(5)->equal(Money::franc(5))
        );
        $this->assertFalse(
            Money::franc(5)->equal(Money::franc(6))
        );
        $this->assertFalse(
            Money::dollar(5)->equal(Money::franc(5))
        );
    }
}