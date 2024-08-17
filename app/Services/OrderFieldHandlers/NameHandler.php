<?php

namespace App\Services\Order;


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
