<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->BearerToken();

        if (!$token || !Auth::guard('api')->validate(['token' => $token])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
