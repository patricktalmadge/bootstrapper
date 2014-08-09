<?php

namespace Bootstrapper\Facades;

class InputGroup extends BootstrapperFacade 
{

    const LARGE = 'input-group-lg';
    const SMALL = 'input-group-sm';

    protected static function getFacadeAccessor()
    {
        return 'inputgroup';
    }

}
