<?php
namespace Bootstrapper;

use \HTML;

/**
 * Alert for creating Twitter Bootstrap style alerts.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Alert
{
  // Alert styles
  const DANGER  = 'alert-danger';
  const ERROR   = 'alert-error';
  const INFO    = 'alert-info';
  const SUCCESS = 'alert-success';
  const WARNING = 'alert-warning';

  /**
   * Create a new Alert.
   *
   * @param string $type         Type of alert
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  protected static function show($type, $message, $enable_close = true, $attributes = array())
  {
    $attributes = Helpers::add_class($attributes, 'alert '.$type);

    $html = '<div'.HTML::attributes($attributes).'>';

    // Add close icon if necessary
    if ($enable_close) {
      $html .= HTML::link('#', '&times;', array('class' => 'close', 'data-dismiss' => 'alert'));
    }

    $html .= $message.'</div>';

    return $html;
  }

  /**
   * Create a new Success Alert.
   *
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function success($message, $enable_close = true, $attributes = array())
  {
    return static::show(Alert::SUCCESS, $message, $enable_close, $attributes);
  }

  /**
   * Create a new Info Alert.
   *
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function info($message, $enable_close = true, $attributes = array())
  {
    return static::show(Alert::INFO, $message, $enable_close, $attributes);
  }

  /**
   * Create a new Warning Alert.
   *
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function warning($message, $enable_close = true, $attributes = array())
  {
    return static::show(Alert::WARNING, $message, $enable_close, $attributes);
  }

  /**
   * Create a new Error Alert.
   *
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function error($message, $enable_close = true, $attributes = array())
  {
    return static::show(Alert::ERROR, $message, $enable_close, $attributes);
  }

  /**
   * Create a new Danger Alert.
   *
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function danger($message, $enable_close = true, $attributes = array())
  {
    return static::show(Alert::DANGER, $message, $enable_close, $attributes);
  }

  /**
   * Create a new custom Alert.
   * This assumes you have created the appropriate css class for the alert type.
   *
   * @param string $type         Type of alert
   * @param string $message      Message in alert
   * @param bool   $enable_close Is Alert closable
   * @param array  $attributes   Parent div attributes
   *
   * @return string              Alert HTML
   */
  public static function custom($type, $message, $enable_close = true, $attributes = array())
  {
    $type = 'alert-'.(string) $type;

    return static::show($type, $message, $enable_close, $attributes);
  }

  /**
   * Check to see if we're calling an informative alert
   *
   * @param string $method     The function called
   * @param array  $parameters Its parameters
   *
   * @return Alert
   */
  public static function __callStatic($method, $parameters)
  {
    // Extract real method and type of alert
    $method = explode('_', $method);
    $isOpen = array_get($method, 0) == 'open';
    $method = array_get($method, 1);

    // If we have an informative alert
    if ($isOpen) {
      // Fetch parameters
      $message  = array_get($parameters, 0);
      $attributes = array_get($parameters, 1);

      return call_user_func('static::'.$method, $message, false, $attributes);
    } else call_user_func('static::'.$method, $parameters);
  }
}
