<?php
/**
 * Bootstrapper Navbar facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Navbar class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Navbar
 */
class Navbar extends BootstrapperFacade
{
    const NAVBAR_INVERSE = 'navbar-inverse';
    const NAVBAR_STATIC = 'navbar-static-top';
    const NAVBAR_TOP = 'navbar-fixed-top';
    const NAVBAR_BOTTOM = 'navbar-fixed-bottom';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::navbar';
    }
}
