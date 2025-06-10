<?php

namespace MedicalappCore\AuthApiBridge\Middleware;

use Closure;
use Illuminate\Http\Request;
use MedicalappCore\AuthApiBridge\Facades\AuthBridge;
use MedicalappCore\AuthApiBridge\BaseResponse;

class VerifyExternalAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !AuthBridge::verifyToken($token)) {
            return BaseResponse::forbidden();
        }

        return $next($request);
    }
}
