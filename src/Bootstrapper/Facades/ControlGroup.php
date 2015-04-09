<?php
/**
 * Bootstrapper ControlGroup facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Control Groups
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\ControlGroup
 */
class ControlGroup extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::controlgroup';
    }
}
