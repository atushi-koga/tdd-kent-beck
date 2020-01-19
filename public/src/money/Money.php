<?php
declare(strict_types=1);

namespace App\src\money;

class Money
{
    /**
     * @var int
     */
    protected $amount;
    /**
     * @var string
     */
    private $currency;

    public function __construct(int $value, string $currency)
    {
        $this->amount = $value;
        $this->currency = $currency;
    }

    public static function dollar(int $value): self
    {
        return new self($value, 'USD');
    }

    public static function franc(int $value): self
    {
        return new self($value, 'CHF');
    }

    public function times(int $multiplier): self
    {
        return new self($this->amount * $multiplier, $this->currency);
    }

    public function equal(self $other): bool
    {
        return $this == $other;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}