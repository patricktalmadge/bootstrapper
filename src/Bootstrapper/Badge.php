<?php
namespace Bootstrapper;

use \HTML;

/**
 * Badge for creating Twitter Bootstrap style Badges.
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
class Badge
{
    /**
     * Badge colors
     *
     * @var constant
     */
    const NORMAL    = '';
    const IMPORTANT = 'badge-important';
    const INFO      = 'badge-info';
    const INVERSE   = 'badge-inverse';
    const SUCCESS   = 'badge-success';
    const WARNING   = 'badge-warning';

    /**
     * Create a new Badge.
     *
     * @param string $type       Type of badge
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    protected static function show($type, $message, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'badge '.$type);

        return '<span'.HTML::attributes($attributes).'>'.$message.'</span>';
    }

    /**
     * Create a new Normal Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function normal($message, $attributes = array())
    {
        return static::show(Badge::NORMAL, $message, $attributes);
    }

    /**
     * Create a new Success Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function success($message, $attributes = array())
    {
        return static::show(Badge::SUCCESS, $message, $attributes);
    }

    /**
     * Create a new Warning Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function warning($message, $attributes = array())
    {
        return static::show(Badge::WARNING, $message, $attributes);
    }

    /**
     * Create a new Important Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function important($message, $attributes = array())
    {
        return static::show(Badge::IMPORTANT, $message, $attributes);
    }

    /**
     * Create a new Info Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function info($message, $attributes = array())
    {
        return static::show(Badge::INFO, $message, $attributes);
    }

    /**
     * Create a new Inverse Badge.
     *
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function inverse($message, $attributes = array())
    {
        return static::show(Badge::INVERSE, $message, $attributes);
    }

    /**
     * Create a new custom Badge.
     * This assumes you have created the appropriate css class for the label type.
     *
     * @param string $type       Type of badge
     * @param string $message    Message in badge
     * @param array  $attributes Parent div attributes
     *
     * @return string Badge HTML
     */
    public static function custom($type, $message, $attributes = array())
    {
        $type = 'badge-'.(string) $type;

        return static::show($type, $message, $attributes);
    }
}
