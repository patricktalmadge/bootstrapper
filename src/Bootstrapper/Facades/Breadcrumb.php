<?php
/**
 * Bootstrapper Breadcrumb facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Breadcrumb class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Breadcrumb
 */
class Breadcrumb extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::breadcrumb';
    }
}
