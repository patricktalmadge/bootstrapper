<?php
namespace Bootstrapper;

use HtmlObject\Element;

/**
 * Label for creating Twitter Bootstrap style Labels.
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
class Label extends Element
{
    /**
     * Label colors
     *
     * @var constant
     */
    protected static $colors = array(
        'normal',
        'important',
        'info',
        'inverse',
        'success',
        'warning',
    );

    /**
     * Dynamically create labels
     */
    public static function __callStatic($method, $parameters)
    {
        // Get Label type
        if ($method == 'normal') $type = null;
        else $type = 'label-'.(string) $method;

        // Get content and attributes
        $content    = isset($parameters[0]) ? $parameters[0] : null;
        $attributes = isset($parameters[1]) ? $parameters[1] : array();

        $label = new static('span', $content, $attributes);
        $label->addClass('label '.$type);

        return $label;
    }

    /**
     * Create a custom label (this is here for backward compatibility)
     *
     * @param string $type       The label type
     * @param string $message    The content
     * @param array  $attributes The attributes
     *
     * @return Label
     */
    public static function custom($type, $message, $attributes)
    {
        return static::$type($message, $attributes);
    }
}
