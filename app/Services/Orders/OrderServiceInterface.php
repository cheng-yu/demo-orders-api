<?php

namespace App\Services\Orders;

interface OrderServiceInterface
{
    public function process(array $orderData): array;
}
