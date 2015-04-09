<?php
/**
 * Bootstrapper Thumbnail Exception
 */

namespace Bootstrapper\Exceptions;

/**
 * Exception used by the Thumbnail class
 *
 * @package Bootstrapper\Exceptions
 * @see     Bootstrapper\Thumbnail
 */
class ThumbnailException extends \Exception
{

    /**
     * Use if the image has not been set on the Thumbnail
     *
     * @return \Bootstrapper\Exceptions\ThumbnailException
     */
    public static function imageNotSpecified()
    {
        return new static(
            'You must specify the image using the "image" method'
        );
    }
}
