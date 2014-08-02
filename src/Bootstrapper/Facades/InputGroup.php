<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class InputGroup extends Facade 
{

    const LARGE = 'input-group-lg';
    const SMALL = 'input-group-sm';

    protected static function getFacadeAccessor()
    {
        return 'inputgroup';
    }

}
