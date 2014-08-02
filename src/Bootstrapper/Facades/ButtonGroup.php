<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class ButtonGroup extends Facade 
{
    const LARGE = 'btn-group-lg';
    const SMALL = 'btn-group-sm';
    const EXTRA_SMALL = 'btn-group-xs';

    const NORMAL = 'btn-default';
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';

    protected static function getFacadeAccessor()
    {
        return 'buttongroup';
    }

}
