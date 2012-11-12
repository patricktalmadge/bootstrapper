<?php
namespace Bootstrapper;

use \HTML;

/**
 * Icon for creating Twitter Bootstrap icons.
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
class Icon
{
    /**
     * Allows magic methods such as Icon::home([attributes]) or Icon::close_white()
     *
     * Sample Usage:
     * <code>
     * <?php
     * Icon::plus();
     * // <i class="icon-plus"></i>
     * Icon::folder_open(array('class'=>'widget','data-foo'=>'bar'));
     * // <i class="widget icon-folder-open" data-foo="bar"></i>
     * Icon::circle_arrow_right_white();
     * // <i class="icon-circle-arrow-right icon-white"></i>
     * ?>
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
        $method_bits = explode('_', strtolower($method));

        // White icon variant? (when using glyphicons sprite version)
        $white = in_array('white', $method_bits);

        // Remove white from array
        $method_bits = array_filter(
            $method_bits,
            function ($val) {
                return ($val != 'white');
            }
        );

        // Get icon name
        $icon_classes = array(implode('-', $method_bits));
        if ($white) $icon_classes[] = 'white';

        // If the parameters weren't put into an array, do it
        if (!isset($parameters[0])) {
            $parameters = array(0 => $parameters);
        }

        // Prepend icon- to classes
        $parameters = Helpers::set_multi_class_attributes(null, $icon_classes, $parameters, 0, Config::get('icons_prefix'));

        return '<i'.HTML::attributes($parameters[0]).'></i>';
    }

    /**
     * Return icon HTML using alternate syntax.
     * Overload via __callStatic() allows calls like Icon::check() or Icon::paper_clip_white()
     * but code-inspecting IDEs will show the method as undefined, and there are just way too many
     * icon classes to use @ method docblock instead
     *
     * Sample Usage:
     * <code>
     * <?php
     * Icon::make('folder-open',array('class'=>'widget'));
     * // <i class="widget icon-folder-open"></i>
     * ?>
     * </code>
     *
     * @param string $icon_class name of the bootstrap icon class
     * @param array  $attributes attributes to apply the icon itself
     *
     * @return string
     */
    public static function make($icon_class, $attributes = array())
    {
        return static::__callStatic($icon_class, $attributes);
    }
}
