<?php
declare(strict_types=1);

namespace App\src\money;

class Dollar
{
    /**
     * @var int
     */
    private $amount;

    public function __construct(int $value)
    {
        $this->amount = $value;
    }

    public function times(int $multiplier): self
    {
        return new self($this->amount * $multiplier);
    }

    public function equal(self $other): bool
    {
        return $this->amount == $other->amount;
    }
}