<?php
namespace Bootstrapper;

use App;
use Illuminate\Support\Facades\Facade;

class HTML extends Facade
{
    /**
     * Redirect calls to HTML facade
     */
    public static function getFacadeAccessor()
    {
        return App::make('html');
    }
}