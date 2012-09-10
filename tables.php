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
   * Closes current table
   *
   * @return string A </table> closing tag
   */
  public static function close()
  {
    return '</table>';
  }

  /**
   * Display an array of data
   * @param  [type] $rows          [description]
   * @param  array  $ignore        [description]
   * @param  array  $supplementary [description]
   * @return [type]                [description]
   */
  public static function display($rows, $ignore = array(), $supplementary = array())
  {
    // Open Table body
    $html = '<tbody>';

    // If no data given, return false
    if(!$rows) return false;

    // Iterate through the data
    foreach($rows as $row) {
      $html .= '<tr>';
      $data = is_object($row) ? $row->attributes : $row;

      // Read the data row with ignored keys
      foreach($data as $column => $value) {
        if(in_array($column, $ignore)) continue;
        $html .= '<td class="column-' .$column. '">'. $value. '</td>';
      }

      // Add supplementary columns
      foreach($supplementary as $class => $column) {
        $column = static::replace_keywords($column, $data);
        $html .= '<td class="'.$class.'">' .$column. '</td>';
      }
      $html .= '</tr>';
    }

    return $html.'</tbody>';
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
   * Replace keywords with data in a string
   *
   * @param  string $string A string with Laravel patterns (:key)
   * @param  array  $data   An array of data to fetch from
   * @return string         The modified string
   */
  private static function replace_keywords($string, $data)
  {
    // Gather used patterns
    preg_match_all('/\(:(.+)\)/', $string, $matches);

    // Replace patterns with data
    foreach($matches[0] as $key => $replace) {
      $with = array_get($matches, '1.'.$key);
      $with = array_get($data, $with);
      $string = str_replace($replace, $with, $string);
    }

    return $string;
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