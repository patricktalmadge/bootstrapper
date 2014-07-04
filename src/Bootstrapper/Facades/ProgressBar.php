<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class ProgressBar extends Facade 
{

    protected static function getFacadeAccessor()
    {
        return 'progressbar';
    }

}