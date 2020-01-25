<?php
declare(strict_types=1);

namespace App\src\money;

class Sum implements Expression
{
    /**
     * @var Money
     */
    public $augend;
    /**
     * @var Money
     */
    public $addend;

    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function reduced(Bank $bank, string $toCurrency): Money
    {
        return new Money(
            $this->augend->amount() + $this->addend->amount(),
            $toCurrency
        );
    }
}