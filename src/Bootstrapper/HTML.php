<?php
namespace Bootstrapper;

use \Illuminate\Routing\UrlGenerator;

class HTML extends \Meido\HTML\HTMLFacade
{
  public static function getFacadeAccessor()
  {
    return new \Meido\HTML\HTML(new UrlGenerator);
  }
}