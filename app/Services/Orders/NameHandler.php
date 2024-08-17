<?php

namespace App\Services\Orders;

class NameHandler implements OrderFieldHandlerInterface
{
    public function validate($value)
    {
        
    }

    public function transform($value)
    {
        return $value; 
    }
}
