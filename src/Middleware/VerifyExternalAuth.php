<?php

namespace MedicalappCore\AuthApiBridge\Middleware;

use Closure;
use Illuminate\Http\Request;
use MedicalappCore\AuthApiBridge\Facades\AuthBridge;
use MedicalappCore\AuthApiBridge\Base\BaseResponse;

class VerifyExternalAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $tokenVerification = AuthBridge::verifyToken($token);

        if (!$token || !$tokenVerification) {
            return BaseResponse::forbidden();
        }

        $request->attributes->set('user', AuthBridge::getUser($token));

        return $next($request);
    }
}
