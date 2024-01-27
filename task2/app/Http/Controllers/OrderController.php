<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\IndexRequest;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }

    public function createOrder(CreateRequest $request)
    {
        try {
            return response()->json($this->orderService->createOrder($request->validated()));
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function getOrderStatus(IndexRequest $request)
    {
        try {
            return response()->json($this->orderService->getOrderStatus($request->validated()));
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        }
    }
}
