<?php
namespace Bootstrapper\Traits;

use HtmlObject\Element;

/**
 * Label for creating Twitter Bootstrap style Labels.
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
abstract class ClassableElement extends Element
{
    /**
     * The base class
     *
     * @var string
     */
    protected static $baseClass = null;

    /**
     * The default element
     *
     * @var string
     */
    protected static $defaultElement = 'span';

    /**
     * Dynamically create labels
     */
    public static function __callStatic($method, $parameters)
    {
        // Get Label type
        $type = ($method == 'normal') ? static::$baseClass . '-default' : static::$baseClass.'-'.(string) $method;


        // Get content and attributes
        
        $content    = isset($parameters[0]) ? $parameters[0] : null;
        $attributes = isset($parameters[1]) ? $parameters[1] : array();

        $element = new static(static::$defaultElement, $content, $attributes);
        $element->addClass(static::$baseClass. ' ' .$type);

        return $element;
    }
}
