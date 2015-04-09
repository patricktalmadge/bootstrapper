<?php
/**
 * Bootstrapper Media Object facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for MediaObject class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\MediaObject
 */
class MediaObject extends BootstrapperFacade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::mediaobject';
    }
}
