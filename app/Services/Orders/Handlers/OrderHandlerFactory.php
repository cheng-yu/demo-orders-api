<?php

namespace App\Services\Orders\Handlers;

class OrderHandlerFactory implements OrderHandlerFactoryInterface
{
    public function make(string $field): OrderFieldHandlerInterface
    {
        switch ($field) {
            case 'name':
                return new NameHandler();
            case 'price':
                return new PriceHandler();
            case 'currency':
                return new CurrencyHandler(new PriceHandler());
            default:
                return new DefaultHandler();
        }
    }
}
