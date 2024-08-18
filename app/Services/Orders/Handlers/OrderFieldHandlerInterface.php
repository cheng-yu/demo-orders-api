<?php

namespace App\Services\Orders\Handlers;

interface OrderFieldHandlerInterface
{
    public function validate($value);
    public function transform($order): array;
}
