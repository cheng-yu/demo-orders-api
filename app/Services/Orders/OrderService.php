<?php

namespace App\Services\Orders;

use App\Services\Orders\Handlers\OrderHandlerFactoryInterface;

class OrderService implements OrderServiceInterface
{
    private $factory;

    public function __construct(OrderHandlerFactoryInterface $orderHandlerFactory)
    {
        $this->factory = $orderHandlerFactory;
    }

    public function process(array $orderData): array
    {
        foreach ($orderData as $field => $value) {
            $handler = $this->factory->make($field);
            $handler->validate($value);
            $orderData = $handler->transform($orderData);
        }

        return $orderData;
    }
}
