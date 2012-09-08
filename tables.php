<?php namespace Bootstrapper;

use \HTML;

/**
 * Small helper class for creating tables with Bootstrap
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Tables
{
  /**
   * Creates a table opening tag
   *
   * @param  array  $attributes An array of attributes
   * @return string             A table opening tag
   */
  public static function table($attributes = array())
  {
    $attributes = Helpers::add_class($attributes, 'table');

    return '<table'.HTML::attributes($attributes).'>';
  }

  /**
   * Creates a table <thead> tag
   *
   * @param  array  $headers An array of thead rows
   * @return string          A <thead> tag prefilled with rows
   */
  public static function headers($headers = array())
  {
    $thead = '<thead>'.PHP_EOL;

    // Add each header with its attributes
    foreach($headers as $header => $attributes) {

      // Allows to not specify an attributes array for leaner syntax
      if(is_string($attributes) and is_numeric($header)) {
        $header = $attributes;
        $attributes = array();
      }

      $thead .= '<th'.HTML::attributes($attributes).'>' .$header. '</th>'.PHP_EOL;
    }

    $thead .= '</thead>'.PHP_EOL;

    return $thead;
  }

  /**
   * Checks call to see if we can create a table from a magic call (for you wizards).
   * hover_striped, bordered_condensed, etc.
   *
   * @param  string  $method
   * @param  array   $parameters
   * @return mixed
  */
  public static function __callStatic($method, $parameters)
  {
    $method_array = explode('_', strtolower($method));

    $function = 'table';

    $parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, 1, 'table-');

    return call_user_func_array('static::'.$function, $parameters);
  }
}