<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargeRequest;
use App\Services\AcquiringService;
use Exception;

class AcquiringController extends Controller
{
    public function __construct(public AcquiringService $service)
    {
    }

    public function checkCard(string $cardNumber)
    {
        try {
            return response()->json($this->service->check($cardNumber));
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function charge(ChargeRequest $request)
    {
        try {
            return response()->json($this->service->chargeCard($request->validated()));
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        }
    }
}
