<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

class Accordion extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'accordion';
    }
}