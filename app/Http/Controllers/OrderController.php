<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function store(OrderRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return response()->json($validatedData);
    }
}
