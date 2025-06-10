<?php

namespace MedicalappCore\AuthApiBridge\Facades;

use Illuminate\Support\Facades\Facade;

class AuthBridge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'authBridge';
    }
}
