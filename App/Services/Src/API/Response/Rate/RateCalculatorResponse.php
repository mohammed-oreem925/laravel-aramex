<?php

namespace App\Services\Src\API\Response\Rate;

use App\Services\Src\API\Classes\Money;
use App\Services\Src\API\Response\Response;

class RateCalculatorResponse extends Response
{
    private $totalAmount;

    /**
     * @return Money
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param Money $totalAmount
     * @return $this
     */
    public function setTotalAmount(Money $totalAmount)
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        $this->setTotalAmount(Money::parse($obj->TotalAmount));

        return $this;
    }

    /**
     * @param object $obj
     * @return RateCalculatorResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
