<?php
namespace Bootstrapper;

use \HTML;

/**
 * Breadcrumb for creating Twitter Bootstrap style breadcrumbs.
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
class Breadcrumb
{
    /**
     * The values that represnts the Breadcrumb separator.
     *
     * @var array
     */
    public static $separator = '/';

    /**
     * Creates the a new Breadcrumb.
     *
     * @param array $links      An array of breadcrumbs links
     * @param array $attributes Attributes to apply the breadcrumbs wrapper
     *
     * @return string A breadcrumbs-styled unordered list
     */
    public static function create($links, $attributes = array())
    {
        // If no links given, cancel
        if (empty($links)) return false;

        // Render each link
        $l = array();
        foreach ($links as $label => $url) {
            $l[] = (is_string($label) or is_array($url))
            ? static::renderItem(HTML::link($url, $label))
            : static::renderItem($url, true);
        }

        // Add global .breadcrumb class
        $attributes = Helpers::add_class($attributes, 'breadcrumb');

        // Wrap in an <ul> tag
        $html = '<ul'.HTML::attributes($attributes).'>';
        $html .= implode('', $l);
        $html .= '</ul>';

        return $html;
    }

    /**
     * Renders a breadcrumb item
     *
     * @param string  $content The item content
     * @param boolean $active  Whether the item is active or not
     *
     * @return string
     */
    protected static function renderItem($content, $active = false)
    {
        // If the link is not active it's the last one, don't append separator
        $separator = !$active ? '<span class="divider">'.static::$separator.'</span>' : '';

        // If it's active, add correspondig class to it
        $class = $active ? ' class="active"' : '';

        // Wrap item in a list item
        $html = '<li'.$class.'>';
        $html .= $content.$separator;
        $html .= '</li>';

        return $html;
    }
}
