<?php

namespace Jmrashed\DomainSubdomain;

use Illuminate\Support\Facades\Facade;

class Calculator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'calculator';
    }
}
