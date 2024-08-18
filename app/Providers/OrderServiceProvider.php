<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Orders\Handlers\OrderHandlerFactory;
use App\Services\Orders\Handlers\OrderHandlerFactoryInterface;
use App\Services\Orders\OrderService;
use App\Services\Orders\OrderServiceInterface;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrderHandlerFactoryInterface::class, function ($app) {
            return new OrderHandlerFactory();
        });

        $this->app->singleton(OrderServiceInterface::class, function ($app) {
            return new OrderService(
                $app->make(OrderHandlerFactoryInterface::class)
            );
        });
    }
}
