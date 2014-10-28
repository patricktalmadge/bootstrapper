<?php
/**
 * Bootstrapper Accordion facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Accordions
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Accordion
 */
class Accordion extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::accordion';
    }
}
