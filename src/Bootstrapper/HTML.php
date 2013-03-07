<?php
namespace Bootstrapper;

use App;
use LaravelBook\Laravel4Powerpack\Facades\HTMLFacade;
use LaravelBook\Laravel4Powerpack\HTML as MeidoHTML;

class HTML extends HTMLFacade
{
    /**
     * Redirect calls to HTML facade
     */
    public static function getFacadeAccessor()
    {
        $url = App::make('url');

        return new MeidoHTML($url);
    }
}