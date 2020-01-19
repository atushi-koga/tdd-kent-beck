<?php
declare(strict_types=1);

namespace App\src\money;

class Dollar extends Money
{
    public function times(int $multiplier): Money
    {
        return new self($this->amount * $multiplier);
    }
}