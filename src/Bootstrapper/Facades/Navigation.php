<?php

namespace Bootstrapper\Facades;

class Navigation extends BootstrapperFacade 
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';
    const NAVIGATION_DIVIDER = 'divider';

    protected static function getFacadeAccessor()
    {
        return 'navigation';
    }

}
