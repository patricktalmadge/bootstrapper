<?php
/**
 * Bootstrapper Helper facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the helpers class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Helpers
 */
class Helpers extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::helpers';
    }
}
