<?php

namespace App\Services\Orders;

class DefaultHandler implements OrderFieldHandlerInterface
{
    public function validate($value) {}

    public function transform($order): array
    {
        return $order; 
    }
}
