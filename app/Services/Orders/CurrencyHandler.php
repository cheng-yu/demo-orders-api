<?php

namespace App\Services\Orders;


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
