<?php


namespace Bootstrapper\Facades;

class ButtonGroup extends BootstrapperFacade 
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
