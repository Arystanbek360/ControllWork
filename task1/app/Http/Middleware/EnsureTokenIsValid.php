<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Authorization header not found.'], 401);
        }

        $token = $request->bearerToken();

        if ($token == config('token.token')) {
            return $next($request);
        }

        return response()->json(['message' => 'Invalid token.'], 401);
    }
}
