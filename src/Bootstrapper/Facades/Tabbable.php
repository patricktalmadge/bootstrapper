<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Tabbable extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'tabbable';
    }

}