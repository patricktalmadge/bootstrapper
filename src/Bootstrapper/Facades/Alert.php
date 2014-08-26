<?php

namespace Bootstrapper\Facades;

class Alert extends BootstrapperFacade
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
