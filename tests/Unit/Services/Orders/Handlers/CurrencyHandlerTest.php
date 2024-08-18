<?php

use App\Services\Orders\Handlers\CurrencyHandler;
use App\Services\Orders\Handlers\PriceHandler;

beforeEach(function () {
    $this->handler = new CurrencyHandler(new PriceHandler());
});

it('validates the currency correctly', function () {

    // Valid currency not throw an exception
    $this->handler->validate('USD');
    $this->handler->validate('TWD');
});

it('validates the currency should be TWD or USD', function () {
    expect(fn () => $this->handler->validate('JPY'))->toThrow(Exception::class);
});

it('should transform the currency to TWD if it is USD', function () {
    $order = ['currency' => 'USD', 'price' => 60];
    $result = $this->handler->transform($order);

    expect($result['currency'])->toBe('TWD');
    expect($result['price'])->toBe(1860);
});

it('should transform the currency to TWD and throw exception if transformed price is over 2000', function () {
    $order = ['currency' => 'USD', 'price' => 100];

    expect(function () use ($order) {
        $this->handler->transform($order);
    })->toThrow(Exception::class);
});