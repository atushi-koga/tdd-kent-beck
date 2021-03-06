<?php
declare(strict_types=1);

namespace App\src\money;

interface Expression
{
    public function plus(Expression $other): Expression;

    public function reduced(Bank $bank, string $toCurrency): Money;
}