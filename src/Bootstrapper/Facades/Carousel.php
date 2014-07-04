<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Carousel extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'carousel';
    }

}