<?php


namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;


class Image extends Facade 
{

    const IMAGE_RESPONSIVE = 'img-responsive';
    const IMAGE_ROUNDED = 'img-rounded';
    const IMAGE_CIRCLE = 'img-circle';
    const IMAGE_THUMBNAIL = 'img-thumbnail';

    protected static function getFacadeAccessor()
    {
        return 'image';
    }

}
