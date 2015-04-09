<?php

namespace Bootstrapper\Exceptions;

use Exception;

/**
 * Class IconException
 *
 * @package Bootstrapper\Exceptions
 * @see     Bootstrapper\Icon
 */
class IconException extends Exception
{

    public static function noIconSpecified()
    {
        return new static('No icon specified when rendering the icon');
    }
}
