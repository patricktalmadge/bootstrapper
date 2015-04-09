<?php

namespace Bootstrapper\Exceptions;

use Exception;

class ButtonGroupException extends Exception
{

    public static function activatedAString()
    {
        return new self(
            'ButtonGroups can only activate options that are instances of Bootstrapper\\Button'
        );
    }
}
