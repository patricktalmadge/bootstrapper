<?php
namespace Bootstrapper;

/**
 * Common helper functions used by Bootstrapper.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see    http://twitter.github.com/bootstrap/
 */
class Helpers
{
  /**
   * Function adds the given value to an array. If the key already
   * exists the value is concatenated to the end of the string.
   * Mainly used for adding classes.
   *
   * @param array  $array array object to be added to
   * @param string $value string value
   * @param string $key   array key to use
   *
   * @return array
  */
  public static function add_class($array, $value, $key = 'class')
  {
    $array[$key] = isset($array[$key]) ? $array[$key].' '.$value : $value;

    return $array;
  }

  /**
   * Function to create a random string of a differing length used for creating IDs
   *
   * @param int $length length of the random string
   *
   * @return string
  */
  public static function rand_string($length)
  {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $size = strlen($chars);
    $str = '';
    for ($i = 0; $i < $length; $i++) {
      $str .= $chars[ rand(0, $size - 1) ];
    }

    return $str;
  }

  /**
   * function used to prime the attributes array for dynamic calls.
   *
   * @param string $exclude    String to exclude from array
   * @param array  $class_array  Class array
   * @param array  $params     Parameters array
   * @param int  $index    Index of the parameters array to use
   * @param string $extra    prefix to the class
   * @param string $extra_unless value to exclude the prefix from
   *
   * @return array
  */
  public static function set_multi_class_attributes($exclude, $class_array, $params, $index, $extra = '', $extra_unless = null)
  {
    if (!isset($params[$index])) $params[$index] = array();
    if (!isset($params[$index]['class'])) $params[$index]['class'] = '';

    foreach ($class_array as $s) {
      if ($s != $exclude) {
        $class = ' '.$extra.$s;
        if (isset($extra_unless) && strpos($s, $extra_unless) !== false) {
          $class = ' '.$s;
        }

        $params[$index]['class'] .= $class;
      }
    }

    $params[$index]['class'] = trim($params[$index]['class']);

    return $params;
  }
}
