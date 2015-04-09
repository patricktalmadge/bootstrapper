<?php
/**
 * Bootstrapper Carousel facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Bootstrapper Carousel
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Carousel
 */
class Carousel extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::carousel';
    }
}
