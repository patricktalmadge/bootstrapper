<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class DropdownButton extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'dropdownbutton';
    }

}