<?php
/**
 * Bootstrapper Modal facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Modal class
 *
 * @package Bootstrapper\Facades
 */
class Modal extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::modal';
    }
}
