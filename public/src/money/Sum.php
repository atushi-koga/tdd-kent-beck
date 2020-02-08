<?php
declare(strict_types=1);

namespace App\src\money;

class Sum implements Expression
{
    /**
     * @var Expression
     */
    public $augend;
    /**
     * @var Expression
     */
    public $addend;

    public function __construct(Expression $augend, Expression $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function plus(Expression $other): Expression
    {
        return new self($this, $other);
    }

    public function reduced(Bank $bank, string $toCurrency): Money
    {
        $augendAmount = $this->augend->reduced($bank, $toCurrency);
        $addendAmount = $this->addend->reduced($bank, $toCurrency);
        return new Money($augendAmount->amount() + $addendAmount->amount(), $toCurrency);
    }
}