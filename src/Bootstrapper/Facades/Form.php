<?php

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    const FORM_HORIZONTAL = 'form-horizontal';
    const FORM_INLINE = 'form-inline';
    const FORM_SUCCESS = 'has-success';
    const FORM_WARNING = 'has-warning';
    const FORM_ERROR = 'has-error';
    const INPUT_LARGE = 'input-lg';

    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::form';
    }

}
