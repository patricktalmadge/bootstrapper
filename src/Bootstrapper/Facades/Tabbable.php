<?php

namespace Bootstrapper\Facades;

class Tabbable extends BootstrapperFacade 
{
    const PILL = 'pill';
    const TAB = 'tab';

    protected static function getFacadeAccessor()
    {
        return 'tabbable';
    }

}
