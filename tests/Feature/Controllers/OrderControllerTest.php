<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    Route::post('/api/orders', [OrderController::class, 'store']);
});

it('successfully processes valid order data', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '2000',
        'currency' => 'TWD'
    ];

    $expectedResponse = $payload;

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(200)
             ->assertJson($expectedResponse);
});

it('successfully processes valid order data with currency transformed', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '60',
        'currency' => 'USD'
    ];

    $expectedResponse = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => 1860,
        'currency' => 'TWD'
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(200)
             ->assertJson($expectedResponse);
});

it('returns validation errors for invalid name', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Invalid Name 123',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '2000',
        'currency' => 'TWD'
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(400)
             ->assertJson(
                 fn (AssertableJson $json) =>
                 $json->where('message', 'Name contains non-English characters')
             );
});

it('returns validation errors for invalid price', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '3000',
        'currency' => 'TWD'
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(400)
             ->assertJson(
                 fn (AssertableJson $json) =>
                 $json->where('message', 'Price is over 2000')
             );
});

it('returns validation errors for invalid price after transform currency', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '65',
        'currency' => 'USD'
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(400)
             ->assertJson(
                 fn (AssertableJson $json) =>
                 $json->where('message', 'Price is over 2000')
             );
});

it('returns validation errors for invalid currency', function () {
    $payload = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road'
        ],
        'price' => '2000',
        'currency' => 'JYP'
    ];

    $response = $this->postJson('/api/orders', $payload);

    $response->assertStatus(400)
             ->assertJson(
                 fn (AssertableJson $json) =>
                 $json->where('message', 'Currency format is wrong')
             );
});