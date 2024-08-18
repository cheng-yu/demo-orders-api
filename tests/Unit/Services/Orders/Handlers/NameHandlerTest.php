<?php

use App\Services\Orders\Handlers\NameHandler;

beforeEach(function () {
    $this->handler = new NameHandler();
});

it('validates the name correctly', function () {
    // Valid name not throw an exception
    $this->handler->validate('John Doe');
});

it('validates the name should be capitalized', function () {
    expect(fn () => $this->handler->validate('John d'))->toThrow(Exception::class);
});

it('validates the name should be English', function () {
    expect(fn () => $this->handler->validate('John123'))->toThrow(Exception::class);
});

it('does not transform the name', function () {
    $order = ['name' => 'John Doe'];
    $result = $this->handler->transform($order);

    expect($result['name'])->toBe('John Doe');
});
