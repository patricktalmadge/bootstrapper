<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class ProgressBar extends Facade 
{

    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';
    const PROGRESS_BAR_INFO = 'progress-bar-info';
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';

    protected static function getFacadeAccessor()
    {
        return 'progressbar';
    }

}
