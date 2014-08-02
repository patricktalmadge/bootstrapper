<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Panel extends Facade 
{

    const PRIMARY = 'panel-primary';
    const SUCCESS = 'panel-success';
    const INFO = 'panel-info';
    const WARNING = 'panel-warning';
    const DANGER = 'panel-danger';

    protected static function getFacadeAccessor()
    {
        return 'panel';
    }

}
