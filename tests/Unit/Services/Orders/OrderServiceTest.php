<?php

use App\Services\Orders\OrderService;
use App\Services\Orders\Handlers\OrderHandlerFactoryInterface;
use App\Services\Orders\Handlers\NameHandler;
use App\Services\Orders\Handlers\PriceHandler;
use App\Services\Orders\Handlers\CurrencyHandler;
use App\Services\Orders\Handlers\DefaultHandler;
use App\Services\Orders\OrderServiceInterface;

beforeEach(function () {
    $this->factoryMock = Mockery::mock(OrderHandlerFactoryInterface::class);
    $this->service = new OrderService($this->factoryMock);
});

it('processes order data with the correct handlers', function () {
    $orderData = [
        'name' => 'John Doe',
        'price' => '1500',
        'currency' => 'TWD'
    ];

    $nameHandlerMock = Mockery::mock(NameHandler::class);
    $priceHandlerMock = Mockery::mock(PriceHandler::class);
    $currencyHandlerMock = Mockery::mock(CurrencyHandler::class);

    $nameHandlerMock->shouldReceive('validate')->with('John Doe')->once();
    $nameHandlerMock->shouldReceive('transform')->with($orderData)->andReturn($orderData)->once();

    $priceHandlerMock->shouldReceive('validate')->with('1500')->once();
    $priceHandlerMock->shouldReceive('transform')->with($orderData)->andReturn($orderData)->once();

    $currencyHandlerMock->shouldReceive('validate')->with('TWD')->once();
    $currencyHandlerMock->shouldReceive('transform')->with($orderData)->andReturn($orderData)->once();

    $this->factoryMock->shouldReceive('make')->with('name')->andReturn($nameHandlerMock)->once();
    $this->factoryMock->shouldReceive('make')->with('price')->andReturn($priceHandlerMock)->once();
    $this->factoryMock->shouldReceive('make')->with('currency')->andReturn($currencyHandlerMock)->once();

    $result = $this->service->process($orderData);

    expect($result)->toEqual($orderData);
});

it('handles unknown fields with DefaultHandler', function () {
    $orderData = [
        'unknown_field' => 'value'
    ];

    $defaultHandlerMock = Mockery::mock(DefaultHandler::class);

    $defaultHandlerMock->shouldReceive('validate')->with('value')->once();
    $defaultHandlerMock->shouldReceive('transform')->with($orderData)->andReturn($orderData)->once();

    $this->factoryMock->shouldReceive('make')->with('unknown_field')->andReturn($defaultHandlerMock)->once();

    $result = $this->service->process($orderData);

    expect($result)->toEqual($orderData);
});
