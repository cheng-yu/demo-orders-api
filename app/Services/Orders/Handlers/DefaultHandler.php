<?php

namespace App\Services\Orders\Handlers;

class DefaultHandler implements OrderFieldHandlerInterface
{
    public function validate($value) {}

    public function transform($order): array
    {
        return $order; 
    }
}
