<?php

namespace App\Services\Orders\Handlers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CurrencyHandler implements OrderFieldHandlerInterface
{
    public function __construct(PriceHandler $priceHandler)
    {
        $this->priceHandler = $priceHandler;
    }

    public function validate($value)
    {
        if (!in_array($value, ['TWD', 'USD'])) {
            throw new HttpResponseException(
                response()->json(['message' => 'Currency format is wrong'], JsonResponse::HTTP_BAD_REQUEST)
            );
        }
    }

    public function transform($order): array
    {

        if ($order['currency'] === 'USD') {
            $price = $order['price'] * 31;
            $this->priceHandler->validate($price);
            $order['price'] = $price;
            $order['currency'] = 'TWD';
        }

        return $order;
    }
}
