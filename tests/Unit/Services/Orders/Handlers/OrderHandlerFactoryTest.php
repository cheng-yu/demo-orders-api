<?php

use App\Services\Orders\Handlers\OrderHandlerFactory;
use App\Services\Orders\Handlers\NameHandler;
use App\Services\Orders\Handlers\PriceHandler;
use App\Services\Orders\Handlers\CurrencyHandler;
use App\Services\Orders\Handlers\DefaultHandler;

beforeEach(function () {
    $this->factory = new OrderHandlerFactory();
});

it('returns a NameHandler when field is name', function () {
    $handler = $this->factory->make('name');
    expect($handler)->toBeInstanceOf(NameHandler::class);
});

it('returns a PriceHandler when field is price', function () {
    $handler = $this->factory->make('price');
    expect($handler)->toBeInstanceOf(PriceHandler::class);
});

it('returns a CurrencyHandler when field is currency', function () {
    $handler = $this->factory->make('currency');
    expect($handler)->toBeInstanceOf(CurrencyHandler::class);
});

it('returns a DefaultHandler when field is unknown', function () {
    $handler = $this->factory->make('unknown');
    expect($handler)->toBeInstanceOf(DefaultHandler::class);
});
