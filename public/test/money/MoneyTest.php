<?php
declare(strict_types=1);

namespace App\test\money;

use App\src\money\Dollar;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $five = new Dollar(5);
        $product1 = $five->times(2);
        $this->assertEquals(10, $product1->amount());

        $product2 = $five->times(3);
        $this->assertEquals(15, $product2->amount());
    }
}