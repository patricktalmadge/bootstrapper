<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Navigation extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'navigation';
    }

}