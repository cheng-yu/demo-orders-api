<?php

namespace App\Services\Orders;

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

    public function transform($value)
    {
        if ($value === 'USD') {
            $this->priceHandler->validate($this->priceHandler->transform($price = request('price') * 31));
            return 'TWD';
        }

        return $value;
    }
}
