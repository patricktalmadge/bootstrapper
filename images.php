<?php namespace Bootstrapper;

use \HTML;

/**
 * Images class for wrapping images with Bootstrap classes
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Images
{
  /**
   * Creates an image with rounded corners
   *
   * @param  string $url        An url
   * @param  string $alt        An alt text
   * @param  array  $attributes An array of attributes
   * @return string             An img tag
   */
  public static function rounded($url, $alt = '', $attributes = array())
  {
    $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

    return HTML::image($url, $alt, $attributes);
  }

  /**
   * Creates an image masked with a circle
   *
   * @param  string $url        An url
   * @param  string $alt        An alt text
   * @param  array  $attributes An array of attributes
   * @return string             An img tag
   */
  public static function circle($url, $alt = '', $attributes = array())
  {
    $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

    return HTML::image($url, $alt, $attributes);
  }

  /**
   * Creates an image with polaroid borders
   *
   * @param  string $url        An url
   * @param  string $alt        An alt text
   * @param  array  $attributes An array of attributes
   * @return string             An img tag
   */
  public static function polaroid($url, $alt = '', $attributes = array())
  {
    $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

    return HTML::image($url, $alt, $attributes);
  }
}