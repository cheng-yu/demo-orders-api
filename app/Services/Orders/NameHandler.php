<?php

namespace App\Services\Orders;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class NameHandler implements OrderFieldHandlerInterface
{
    public function validate($value)
    {
        if (preg_match('/[^A-Za-z\s]/', $value)) {
            throw new HttpResponseException(
                response()->json(['message' => 'Name contains non-English characters'], JsonResponse::HTTP_BAD_REQUEST)
            );
        }

        $words = explode(' ', $value);
        foreach ($words as $word) {
            if ($word[0] !== strtoupper($word[0])) {
                throw new HttpResponseException(
                    response()->json(['message' => 'Name is not capitalized'], JsonResponse::HTTP_BAD_REQUEST)
                );
            }
        } 
    }

    public function transform($order): array
    {
        return $order; 
    }
}
