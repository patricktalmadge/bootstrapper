<?php

namespace Bootstrapper\Facades;

class Navigation extends BootstrapperFacade 
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';

    protected static function getFacadeAccessor()
    {
        return 'navigation';
    }

}
