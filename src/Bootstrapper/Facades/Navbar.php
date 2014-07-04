<?php

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Navbar extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'navbar';
    }

}