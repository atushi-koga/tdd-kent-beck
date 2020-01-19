<?php
declare(strict_types=1);

namespace App\src\money;

abstract class Money
{
    /**
     * @var int
     */
    protected $amount;

    public static function dollar(int $value): self
    {
        return new Dollar($value);
    }

    public static function franc(int $value): self
    {
        return new Franc($value);
    }

    abstract function times(int $multiplier): self;

    public function equal(self $other): bool
    {
        return $this == $other;
    }
}