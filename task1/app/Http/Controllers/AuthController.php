<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            return response()->json($this->service->login($request->validated()));
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function register(RegisterRequest $request)
    {
        return response()->json($this->service->register($request->validated()));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function me()
    {
        return UserResource::make(auth()->user());
    }
}
