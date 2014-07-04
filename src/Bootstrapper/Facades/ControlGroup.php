<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class ControlGroup extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'controlgroup';
    }

}