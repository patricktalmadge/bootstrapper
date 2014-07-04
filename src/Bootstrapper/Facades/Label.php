<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Label extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'label';
    }

}