<?php
declare(strict_types=1);

namespace App\src\money;

class Bank
{
    public function reduced(Expression $expression, string $toCurrency): Money
    {
        return $expression->reduced($toCurrency);
    }
}