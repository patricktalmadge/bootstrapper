<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Icon extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'icon';
    }

}