<?php
namespace Bootstrapper;

use \Config as LaravelConfig;

/**
 * Custom config class for Bootstrapper allowing extra endpoints
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Config
{
  /**
   * Get the value of an option
   *
   * @param  string $key      The option to get
   * @param  string $fallback A fallback if undefined
   * @return string           The option value
   */
  public static function get($key, $fallback = null)
  {
    $user   = LaravelConfig::get('bootstrapper.'.$key, null);
    $vendor = LaravelConfig::get('bootstrapper::bootstrapper.'.$key, $fallback);

    return is_null($user) ? $vendor : $user;
  }

  /**
   * Set an option
   *
   * @param string $key   The option to set
   * @param string $value Its new value
   */
  public static function set($key, $value)
  {
    LaravelConfig::set('bootstrapper::bootstrapper.'.$key, $value);
  }
}
