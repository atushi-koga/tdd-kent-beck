<?php
declare(strict_types=1);

namespace App\src\money;

class Money implements Expression
{
    /**
     * @var int
     */
    protected $amount;
    /**
     * @var string
     */
    private $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function dollar(int $amount): self
    {
        return new self($amount, 'USD');
    }

    public static function franc(int $amount): self
    {
        return new self($amount, 'CHF');
    }

    public function times(int $multiplier): self
    {
        return new self($this->amount * $multiplier, $this->currency);
    }

    public function equal(self $other): bool
    {
        return $this == $other;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function plus(Money $other): Sum
    {
        return new Sum($this, $other);
    }

    public function reduced(string $toCurrency): Money
    {
        return $this;
    }
}