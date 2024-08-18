<?php

namespace App\Services\Orders;

interface OrderHandlerFactoryInterface
{
    public function make(string $field): OrderFieldHandlerInterface;
}