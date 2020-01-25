<?php
declare(strict_types=1);

namespace App\src\money;

class Pair
{
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function same(): bool
    {
        return $this->from === $this->to;
    }

    public function equal(self $other): bool
    {
        return $this == $other;
    }
}