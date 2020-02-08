<?php
declare(strict_types=1);

namespace App\src\money;

class Ratio
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value) // @todo: 小数に対応させる
    {
        $this->value = $value;
    }

    public static function one(): self
    {
        return new self(1);
    }

    public function value(): int
    {
        return $this->value;
    }
}