<?php

namespace App\Services\Orders\Handlers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class PriceHandler implements OrderFieldHandlerInterface
{
    public function validate($value)
    {
        if ($value > 2000) {
            throw new HttpResponseException(
                response()->json(['message' => 'Price is over 2000'], JsonResponse::HTTP_BAD_REQUEST)
            );
        }
    }

    public function transform($order): array
    {
        return $order; 
    }
}
