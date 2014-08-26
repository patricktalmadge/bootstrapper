<?php

namespace Bootstrapper\Facades;

class DropdownButton extends BootstrapperFacade 
{
    const DIVIDER = "<li class='divider'></li>";
    const PRIMARY = 'btn-primary';
    const DANGER = 'btn-danger';
    const WARNING = 'btn-warning';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const LARGE = 'btn-lg';
    const SMALL = 'btn-sm';
    const EXTRA_SMALL = 'btn-xs';

    protected static function getFacadeAccessor()
    {
        return 'dropdownbutton';
    }

}
