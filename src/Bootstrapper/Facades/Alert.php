<?php

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

class Alert extends Facade
{
    const INFO = 'alert-info';
    const SUCCESS = 'alert-success';
    const WARNING = 'alert-warning';
    const DANGER = 'alert-danger';

    protected static function getFacadeAccessor()
    {
        return 'alert';
    }

}
