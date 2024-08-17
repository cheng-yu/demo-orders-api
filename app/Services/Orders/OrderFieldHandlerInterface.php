<?php

namespace App\Services\Orders;

interface OrderFieldHandlerInterface
{
    public function validate($value);
    public function transform($value);
}
