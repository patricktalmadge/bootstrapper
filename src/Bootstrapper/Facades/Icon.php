<?php
/**
 * Bootstrapper Icon facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Icon class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Icon
 */
class Icon extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::icon';
    }
}
