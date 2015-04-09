<?php
/**
 * Bootstrapper Tabbable facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Tabbable class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Tabbable
 */
class Tabbable extends BootstrapperFacade
{
    const PILL = 'pill';
    const TAB = 'tab';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::tabbable';
    }
}
