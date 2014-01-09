<?php
namespace Bootstrapper;

use HtmlObject\Element;
use HtmlObject\Lists;

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
        $listItems = array();
        foreach ($links as $label => $url) {
            $listItems[] = (is_string($label) or is_array($url))
            ? static::renderItem(Helpers::getContainer('html')->link($url, $label))
            : static::renderItem($url, true);
        }

        return Lists::ul($listItems, $attributes)->addClass('breadcrumb');
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
        $item = Element::li($content);

        // If the link is not active it's the last one, don't append separator
        if($active) $item->addClass('active');
        return $item;
    }
}
