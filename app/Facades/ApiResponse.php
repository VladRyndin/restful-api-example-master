<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ApiResponse';
    }
}
