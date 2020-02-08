<?php
declare(strict_types=1);

namespace App\src\money;

class Bank
{
    /**
     * @var Rates
     */
    private $rates;

    public function __construct(Rates $rates)
    {
        $this->rates = $rates;
    }

    public function reduced(Expression $expression, string $toCurrency): Money
    {
        return $expression->reduced($this, $toCurrency);
    }

    public function addRate(Rate $rate): self
    {
        return new self($this->rates->put($rate));
    }

    public function ratio(Pair $pair): Ratio
    {
        return $pair->same() ? Ratio::one() : $this->rates->findOrFail($pair)->ratio();
    }
}