<?php
declare(strict_types=1);

namespace App\src\money;

class Rates
{
    /**
     * @var Rate[]
     */
    private $value;

    public function __construct(array $rates)
    {
        $this->value = $rates;
    }

    public function put(Rate $other): self
    {
        // @todo: ループ中に同じPairがあれば差し替え、なければ追加
        return new self(array_merge($this->value, [$other]));
    }

    public function findOrFail(Pair $other): Rate
    {
        foreach ($this->value as $rate) {
            if ($rate->pair()->equal($other)) {
                return $rate;
            }
        }
        throw new \InvalidArgumentException('未定義のPair');
    }
}