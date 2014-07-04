<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class MediaObject extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'mediaobject';
    }

}