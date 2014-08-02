<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Tabbable extends Facade 
{
    const PILL = 'pill';
    const TAB = 'tab';

    protected static function getFacadeAccessor()
    {
        return 'tabbable';
    }

}
