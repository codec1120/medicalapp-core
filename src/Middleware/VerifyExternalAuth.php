<?php

namespace LaravelCore\AuthApiBridge\Middleware;

use Closure;
use Illuminate\Http\Request;
use LaravelCore\AuthApiBridge\Facades\AuthBridge;
use LaravelCore\Base\Response;

class VerifyExternalAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !AuthBridge::verifyToken($token)) {
            return Response::forbidden();
        }

        return $next($request);
    }
}
