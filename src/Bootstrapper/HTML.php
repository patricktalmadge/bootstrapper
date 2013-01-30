<?php
namespace Bootstrapper;

use \App;
use \Meido\HTML\HTMLFacade;
use \Meido\HTML\HTML as MeidoHTML;

class HTML
{
  public static $html;

  public static function construct($html)
  {
    static::$html = $html;
  }

  public static function __callStatic($method, $parameters)
  {
    return call_user_func_array(array(static::$html, $method), $parameters);
  }
}