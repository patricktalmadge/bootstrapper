<?php
/**
 * Bootstrapper Navigation facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Navigation class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Navigation
 */
class Navigation extends BootstrapperFacade
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';
    const NAVIGATION_DIVIDER = 'divider';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::navigation';
    }
}
