<?php

namespace MedicalappCore\AuthApiBridge\Services;

class Clinic
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('authbridge.clinic.api_base');
    }
}
