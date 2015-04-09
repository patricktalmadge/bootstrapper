<?php
/**
 * Bootstrapper Image facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Image class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Image
 */
class Image extends BootstrapperFacade
{

    const IMAGE_RESPONSIVE = 'img-responsive';
    const IMAGE_ROUNDED = 'img-rounded';
    const IMAGE_CIRCLE = 'img-circle';
    const IMAGE_THUMBNAIL = 'img-thumbnail';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::image';
    }
}
