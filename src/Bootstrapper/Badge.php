<?php
namespace Bootstrapper;

use Bootstrapper\Traits\ClassableElement;

/**
 * Badge for creating Twitter Bootstrap style Badges.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @author     Patrick Rose - <pjr0911025@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Badge extends ClassableElement
{
  /**
   * The base class
   *
   * @var string
   */
  protected static $baseClass = 'badge';

  /**
   * Create a custom label (this is here for backward compatibility)
   *
   * @param string $type       The badge type
   * @param string $message    The content
   * @param array  $attributes The attributes
   *
   * @return Badge
   */
  public static function custom($type, $message, $attributes)
  {
    return static::$type($message, $attributes);
  }

  /**
   * Bootstrap no longer has specific badge classes, so we seperate
   * them.
   */
  public static function __callStatic($method, $parameters)
  {
    $parameters[1] = isset($parameters[1]) ? $parameters[1] : array(); 
    $badge = parent::$method($parameters[0], $parameters[1]);
    return str_replace('badge-', null, str_replace('default', null, $badge));
  }
}
