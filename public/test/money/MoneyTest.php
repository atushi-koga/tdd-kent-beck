<?php
declare(strict_types=1);

namespace App\test\money;

use App\src\money\Bank;
use App\src\money\Money;
use App\src\money\Pair;
use App\src\money\Rate;
use App\src\money\Rates;
use App\src\money\Ratio;
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
        $bank = new Bank(new Rates([]));
        $this->assertEquals(Money::dollar(10), $bank->reduced($result, 'USD'));
    }

    public function testReduceMoney()
    {
        $bank = new Bank(new Rates([]));
        $this->assertEquals(
            Money::dollar(5),
            $bank->reduced(Money::dollar(5), 'USD')
        );
    }

    public function testReduceMoneyDifferentCurrency()
    {
        $rate = new Rate(new Pair('CHF', 'USD'), new Ratio(2));
        $bank = new Bank(new Rates([$rate]));
        $this->assertEquals(
            Money::dollar(1),
            $bank->reduced(Money::franc(2), 'USD')
        );
    }

    public function testReduceSum()
    {
        $sum = new Sum(Money::dollar(4), Money::dollar(6));
        $bank = new Bank(new Rates([]));
        $this->assertEquals(
            Money::dollar(10),
            $bank->reduced($sum, 'USD')
        );
    }

    public function testPlusReturnsSum() {
        $fourDollar = Money::dollar(4);
        $sixDollar = Money::dollar(6);
        $this->assertEquals(
            new Sum($fourDollar, $sixDollar),
            $fourDollar->plus($sixDollar)
        );
    }

    public function testPlusDifferentCurrency()
    {
        $fiveDollar = Money::dollar(5);
        $tenFranc = Money::franc(10);
        $bank = new Bank(
            new Rates([
                new Rate(new Pair('CHF', 'USD'), new Ratio(2))
            ])
        );
        $this->assertEquals(
            Money::dollar(10),
            $bank->reduced($fiveDollar->plus($tenFranc), 'USD')
        );
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

    /**
     * @noinspection NonAsciiCharacters
     * @test
     */
    public function 合計値に対し加算する()
    {
        $bank = new Bank(
            new Rates([
                new Rate(new Pair('CHF', 'USD'), new Ratio(2)),
            ])
        );
        $oneDollar = Money::dollar(1);
        $twoDollar = Money::dollar(2);
        $threeDollar = Money::dollar(3);
        $this->assertEquals(
            Money::dollar(6),
            (new Sum($oneDollar, $twoDollar))
                ->plus($threeDollar)
                ->reduced($bank, 'USD')
        );

        $twoDollar = Money::dollar(2);
        $twoFranc = Money::franc(2);
        $fourFranc = Money::franc(4);
        $this->assertEquals(
            Money::dollar(5),
            (new Sum($twoDollar, $twoFranc))
            ->plus($fourFranc)
            ->reduced($bank, 'USD')
        );
    }
}