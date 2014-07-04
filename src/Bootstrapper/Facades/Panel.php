<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Panel extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'panel';
    }

}