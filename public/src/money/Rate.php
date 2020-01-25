<?php
declare(strict_types=1);

namespace App\src\money;

class Rate
{
    /**
     * @var Pair
     */
    private $pair;
    /**
     * @var Ratio
     */
    private $ratio;

    public function __construct(Pair $pair, Ratio $ratio)
    {
        $this->pair = $pair;
        $this->ratio = $ratio;
    }

    public function pair(): Pair
    {
        return $this->pair;
    }

    public function ratio(): Ratio
    {
        return $this->ratio;
    }
}