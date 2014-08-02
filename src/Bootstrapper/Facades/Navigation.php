<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Navigation extends Facade 
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';

    protected static function getFacadeAccessor()
    {
        return 'navigation';
    }

}
