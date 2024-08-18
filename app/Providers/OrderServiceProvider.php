<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Orders\NameHandler;
use App\Services\Orders\PriceHandler;
use App\Services\Orders\CurrencyHandler;
use App\Services\Orders\OrderService;
use App\Services\Orders\OrderServiceInterface;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NameHandler::class);
        $this->app->bind(PriceHandler::class);
        $this->app->bind(CurrencyHandler::class);
        $this->app->singleton(OrderServiceInterface::class, function ($app) {
            return new OrderService(
                $app->make(NameHandler::class),
                $app->make(PriceHandler::class),
                $app->make(CurrencyHandler::class)
            );
        });
    }
}
