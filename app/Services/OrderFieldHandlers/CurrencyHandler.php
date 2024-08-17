<?php

namespace App\Services\Order;


class CurrencyHandler implements OrderFieldHandlerInterface
{
    public function validate($value)
    {
        
    }

    public function transform($value)
    {
        return $value; 
    }
}
