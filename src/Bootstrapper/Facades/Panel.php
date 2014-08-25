<?php

namespace Bootstrapper\Facades;

class Panel extends BootstrapperFacade 
{

    const PRIMARY = 'panel-primary';
    const SUCCESS = 'panel-success';
    const INFO = 'panel-info';
    const WARNING = 'panel-warning';
    const DANGER = 'panel-danger';
    const NORMAL = 'panel-default';

    protected static function getFacadeAccessor()
    {
        return 'panel';
    }

}
