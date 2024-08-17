<?php

namespace App\Services\Order;

interface OrderFieldHandlerInterface
{
    public function validate($value);
    public function transform($value);
}
