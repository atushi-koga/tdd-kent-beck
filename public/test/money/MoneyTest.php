<?php
declare(strict_types=1);

namespace App\test\money;

use App\src\money\Bank;
use App\src\money\Money;
use App\src\money\Sum;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $fiveDollar = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $fiveDollar->times(2));
        $this->assertEquals(Money::dollar(15), $fiveDollar->times(3));
    }

    public function testSimpleAddition()
    {
        $fiveDollar = Money::dollar(5);
        $result = $fiveDollar->plus($fiveDollar);
        $bank = new Bank();
        $this->assertEquals(Money::dollar(10), $bank->reduced($result, 'USD'));
    }

    public function testReduceMoney()
    {
        $bank = new Bank();
        $this->assertEquals(
            Money::dollar(5),
            $bank->reduced(Money::dollar(5), 'USD')
        );
    }

    public function testReduceSum()
    {
        $sum = new Sum(Money::dollar(4), Money::dollar(6));
        $bank = new Bank();
        $this->assertEquals(
            Money::dollar(10),
            $bank->reduced($sum, 'USD')
        );
    }

    public function testPlusReturnsSum() {
        $fiveDollar = Money::dollar(5);
        $result = $fiveDollar->plus($fiveDollar);
        $this->assertEquals($fiveDollar, $result->augend);
        $this->assertEquals($fiveDollar, $result->addend);
    }

    public function testEquality()
    {
        $this->assertTrue(Money::dollar(5)->equal(Money::dollar(5)));
        $this->assertFalse(Money::dollar(5)->equal(Money::dollar(6)));
        $this->assertFalse(Money::dollar(5)->equal(Money::franc(5)));
    }

    public function testCurrency()
    {
        $this->assertEquals('USD', Money::dollar(1)->currency());
        $this->assertEquals('CHF', Money::franc(1)->currency());
    }
}