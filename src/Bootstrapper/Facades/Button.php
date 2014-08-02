<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Button extends Facade 
{
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';
    const LINK = 'btn-link';
    const LARGE = 'btn-lg';
    const SMALL = 'btn-sm';
    const EXTRA_SMALL = 'btn-xs';

    protected static function getFacadeAccessor()
    {
        return 'button';
    }

}
