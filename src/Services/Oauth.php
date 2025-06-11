<?php

namespace MedicalappCore\AuthApiBridge\Services;

use Illuminate\Support\Facades\Http;

class Oauth
{
    protected string $apiBase;

    public function __construct()
    {
        $this->apiBase = config('authBridge.oauth.api_base');
    }

    public function verifyToken(string $token): bool
    {
        $response = Http::withToken($token)->get($this->apiBase . '/auth/verify');

        if ($response->ok() && $response->json('valid') === true) {
            return $response->json('user');
        } 

        return false;
    }

    public function getUser(string $token): array
    {
        return Http::withToken($token)
                   ->get($this->apiBase . '/user')
                   ->json();
    }
}
