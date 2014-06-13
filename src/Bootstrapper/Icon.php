<?php
namespace Bootstrapper;

use HtmlObject\Traits\Tag;

/**
 * Icon for creating Twitter Bootstrap icons.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @author     Patrick Rose - <pjr0911025@gmail.com>
 * @author     Marvin Schröder - <marvinschroeder85@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Icon extends Tag
{
    /**
     * The Tag element
     *
     * @var string
     */
    protected $element = 'i';

   /**
     * Build a new icon
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        $this->attributes = $attributes;
    }
    
    /**
     * Allows magic methods such as Icon::home([attributes]) or Icon::close_white()
     *
     * Sample Usage:
     * <code>
     * Icon::plus();
     * // <i class="icon-plus"></i>
     * Icon::folder_open(array('class'=>'widget','data-foo'=>'bar'));
     * // <i class="widget icon-folder-open" data-foo="bar"></i>
     * Icon::circle_arrow_right_white();
     * // <i class="icon-circle-arrow-right icon-white"></i>
     * </code>
     *
     * @param string $method     Name of missing method
     * @param array  $parameters array of parameters passed to missing method
     *
     * @return string
     */
    public static function __callStatic($method, $parameters)
    {
        // Explode method name
        $classes = explode('_', strtolower($method));
        $white = in_array('white', $classes);
        if ($white) unset($classes[array_search('white', $classes)]);

      
        // Concatenate icons
        $classes = Helpers::getContainer('config')->get('bootstrapper::icon_prefix') . implode('-', $classes);
        if ($white) $classes .= ' ' .Helpers::getContainer('config')->get('bootstrapper::icon_prefix').'white';
        $classes = Helpers::getContainer('config')->get('bootstrapper::icon_class') . ' ' . $classes;

        $attributes = isset($parameters[0]) ? $parameters[0] : $parameters;

        $icon = new static($attributes);
        $icon->addClass($classes);

        return $icon;
    }

    /**
     * Return icon HTML using alternate syntax.
     * Overload via __callStatic() allows calls like Icon::check() or Icon::paper_clip_white()
     * but code-inspecting IDEs will show the method as undefined, and there are just way too many
     * icon classes to use @ method docblock instead
     *
     * Sample Usage:
     * <code>
     * Icon::make('folder-open',array('class'=>'widget'));
     * // <i class="widget icon-folder-open"></i>
     * </code>
     *
     * @param string $icon       Name of the bootstrap icon class
     * @param array  $attributes Attributes to apply the icon itself
     *
     * @return string
     */
    public static function make($icon, $attributes = array())
    {
        return static::__callStatic($icon, $attributes);
    }
}
