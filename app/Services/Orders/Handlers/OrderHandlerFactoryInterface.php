<?php

namespace App\Services\Orders\Handlers;

interface OrderHandlerFactoryInterface
{
    public function make(string $field): OrderFieldHandlerInterface;
}