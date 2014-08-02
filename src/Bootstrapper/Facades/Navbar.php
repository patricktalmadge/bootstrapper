<?php

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Navbar extends Facade 
{
    const NAVBAR_INVERSE = 'navbar-inverse';
    const NAVBAR_STATIC = 'navbar-static-top';
    const NAVBAR_TOP = 'navbar-fixed-top';
    const NAVBAR_BOTTOM = 'navbar-fixed-bottom';

    protected static function getFacadeAccessor()
    {
        return 'navbar';
    }

}