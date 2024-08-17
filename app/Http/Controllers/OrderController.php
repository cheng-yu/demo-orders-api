<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\Orders\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $validatedData = $this->orderService->process($validatedData);

        return response()->json($validatedData);
    }
}
