<?php
/**
 * Bootstrapper Badge facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Bootstrapper Badges
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Badge
 */
class Badge extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::badge';
    }
}
