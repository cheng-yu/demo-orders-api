<?php

namespace App\Services\Orders;

class OrderService
{
    protected $handlers;

    public function __construct(NameHandler $nameHandler, PriceHandler $priceHandler, CurrencyHandler $currencyHandler)
    {
        $this->handlers = [
            'name' => $nameHandler,
            'price' => $priceHandler,
            'currency' => $currencyHandler,
        ];
    }

    public function process(array $orderData): array
    {
        foreach ($this->handlers as $field => $handler) {
            if (isset($orderData[$field])) {
                $handler->validate($orderData[$field]);
                $orderData[$field] = $handler->transform($orderData[$field]);
            }
        }

        return $orderData;
    }
}
