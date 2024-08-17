<?php

namespace App\Services\Order;


class PriceHandler implements OrderFieldHandlerInterface
{
    public function validate($value)
    {
        
    }

    public function transform($value)
    {
        return $value; 
    }
}
