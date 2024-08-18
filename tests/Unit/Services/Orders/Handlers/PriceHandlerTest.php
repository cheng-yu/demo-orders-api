<?php

use App\Services\Orders\Handlers\PriceHandler;

beforeEach(function () {
    $this->handler = new PriceHandler();
});

it('validates the price correctly', function () {
    // Valid price not throw an exception
    $this->handler->validate(100);
});

it('validates the price should lower than 2000', function () {
    expect(fn () => $this->handler->validate(3000))->toThrow(Exception::class);
});

it('does not transform the price', function () {
    $order = ['price' => 100];
    $result = $this->handler->transform($order);

    expect($result['price'])->toBe(100);
});