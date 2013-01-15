<?php
namespace Bootstrapper;

use \App;
use \Illuminate\Routing\UrlGenerator;

class HTML extends \Meido\HTML\HTMLFacade
{
  public static function getFacadeAccessor()
  {
    $url = App::make('url');

    return new \Meido\HTML\HTML($url);
  }
}