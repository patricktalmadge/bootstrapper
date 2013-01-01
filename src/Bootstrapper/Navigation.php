<?php
namespace Bootstrapper;

use \HTML;

/**
 * Navigation for creating Twitter Bootstrap menus.
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
class Navigation
{
    /**
     * Menu types
     * @var constant
     */
    const TYPE_UNSTYLED = '';
    const TYPE_LIST     = 'nav-list';
    const TYPE_PILLS    = 'nav-pills';
    const TYPE_TABS     = 'nav-tabs';

    const HEADER        = '-HEADER-';
    const DIVIDER          = '---';
    const VERTICAL_DIVIDER = '|||';

    /**
     * Generates a nav menu and any dropdown if the $list array contains any dropdown objects.
     *
     * @param array  $list       Menu items
     * @param string $type       Menu Type
     * @param bool   $stacked    Should menu be stacked
     * @param array  $attributes attributes to apply the nav
     * @param bool   $autoroute  Autoroute links
     *
     * @return string
     */
    public static function menu($list, $type = Navigation::TYPE_UNSTYLED, $stacked = false, $attributes = array(), $autoroute = true, $isDropdown = false)
    {
        $html = '';

        if (isset($type)) {
            $type = $type != '' ? ' '.$type : '';
            $attributes = Helpers::add_class($attributes, 'nav'.$type);
        }

        if ($type !== Navigation::TYPE_LIST && $stacked) {
            $attributes = Helpers::add_class($attributes, 'nav-stacked');
        }

        if (count($list) == 0) {
            return $html;
        }

        foreach ($list as $item) {
            $icon = isset($item['icon']) ? $item['icon'] : null;

            // Set vertical dividers
            if ($item['label'] === Navigation::VERTICAL_DIVIDER) {
                $html .= '<li class="divider-vertical"></li>';

            // Set normal divider
            } elseif ($item['label'] === Navigation::DIVIDER) {
                $html .= '<li class="divider"></li>';

            // Set Header if Label Equals HEADER const
            } elseif ($item['label'] === Navigation::HEADER) {
                $iconStr = "";
                if ($icon !== null) {
                    $iconStr = Icon::$icon().' ';
                }

                $html .= '<li class="nav-header">'.$iconStr.HTML::entities($item['url']).'</li>';

            // Set dropdown style
            } elseif (isset($item['items'])) {
                $dropClass = 'dropdown';
                $att = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown');
                $extraCaret = ' <b class="caret"></b>';

                if ($isDropdown) {
                    $dropClass = 'dropdown-submenu';
                    $att = array();
                    $extraCaret = '';
                }

                $html .= '<li class="'.$dropClass.' '.static::getClasses($item, false, $autoroute).'">';
                $html .= static::linkItem($item['url'], $item['label'].$extraCaret, $att, false, $icon);
                $html .= static::dropdown($item['items'], array(), $autoroute);
                $html .= '</li>';

            // Must be basic link
            } else {
                if (!isset($item['attributes'])) {
                    $item['attributes'] = array();
                }

                $html .= '<li '.static::getClasses($item, true, $autoroute).'>'.static::linkItem($item['url'], $item['label'], $item['attributes'], true, $icon).'</li>';
            }
        }

        return '<ul'.HTML::attributes($attributes).'>'.$html.'</ul>';
    }

    /**
     * Creates a Bootstrap plan unstyled menu.
     *
     * @param array $list       Menu items
     * @param bool  $stacked    Should it be stacked
     * @param array $attributes attributes to apply the nav
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    public static function unstyled($list, $stacked = false, $attributes = array(), $autoroute = true)
    {
        return static::menu($list, Navigation::TYPE_UNSTYLED, $stacked, $attributes, $autoroute);
    }

    /**
     * Creates a Bootstrap Tabs menu.
     *
     * @param array $list       Menu items
     * @param bool  $stacked    Should it be stacked
     * @param array $attributes attributes to apply the nav
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    public static function tabs($list, $stacked = false, $attributes = array(), $autoroute = true)
    {
        return static::menu($list, Navigation::TYPE_TABS, $stacked, $attributes, $autoroute);
    }

    /**
     * Creates a Bootstrap Pills menu.
     *
     * @param array $list       Menu items
     * @param bool  $stacked    Should it be stacked
     * @param array $attributes attributes to apply the nav
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    public static function pills($list, $stacked = false, $attributes = array(), $autoroute = true)
    {
        return static::menu($list, Navigation::TYPE_PILLS, $stacked, $attributes, $autoroute);
    }

    /**
     * Creates a Bootstrap Lists menu.
     *
     * @param array $list       Menu items
     * @param bool  $stacked    Should it be stacked
     * @param array $attributes attributes to apply the nav
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    public static function lists($list, $stacked = false, $attributes = array(), $autoroute = true)
    {
        return static::menu($list, Navigation::TYPE_LIST, $stacked, $attributes, $autoroute);
    }

    /**
     * Creates a Bootstrap Dropdown menu.
     *
     * @param array $list       Menu items
     * @param array $attributes attributes to apply the nav
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    public static function dropdown($list, $attributes = array(), $autoroute = true)
    {
        $attributes = Helpers::add_class($attributes, 'dropdown-menu');

        return static::menu($list, null, false, $attributes, $autoroute, true);
    }

    /**
     * Creates the class element for the menu item.
     *
     * @param array $item       item array
     * @param bool  $with_class with class
     * @param bool  $autoroute  Autoroute links
     *
     * @return string
     */
    protected static function getClasses($item, $with_class = true, $autoroute = true)
    {
        $class = '';
        if ((isset($item['active']) && $item['active']) || ($autoroute && \URL::current() == $item['url'])) {
            $class = 'active';
        }

        if (isset($item['disabled']) && $item['disabled']) {
            $class = $class == '' ? '' : ' ';
            $class .= 'disabled';
        }

        $class .= isset($item['align']) ? ' '.$item['align'] : '';

        if (strlen($class) > 0 && $with_class) {
            $class = 'class="'.$class.'"';
        }

        return $class;
    }

    /**
     * Generates a link without doing a getting the full url from Laravel
     *
     * @param string $url        Url for the link
     * @param string $title      Title for thel ink
     * @param array  $attributes Attributes to apply to the link
     * @param bool   $encode     Encode title
     * @param string $icon       Icon for the link
     *
     * @return string
     */
    protected static function linkItem($url, $title, $attributes = array(), $encode = true, $icon = null)
    {
        if ($encode) {
            $title = HTML::entities($title);
        }

        if (isset($icon)) {
            $title = Icon::$icon().' '.$title;
        }

        return '<a href="'.$url.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
    }

        /**
     * A simple clean way to create a single link array.
     *
     * @param string $label    Link name
     * @param bool   $active   Set current tab as active
     * @param bool   $disabled Disabled the current tab
     * @param array  $items    Array of for dropdown items
     *
     * @return mixed
     */
    public static function link($label, $url, $active = false, $disabled = false, $items = null, $icon = null)
    {
        return array('label'=> $label, 'url' => $url, 'active' => $active, 'disabled' => $disabled, 'items' => $items, 'icon' => $icon);
    }

    /**
     * A simple clean way to create the associative array required for a Navigation item
     *
     * @param array $links array of links
     *
     * @return mixed
     */
    public static function links($links)
    {
        if ($links == null) {
            return $links;
        }

        $l = array();
        foreach ($links as $key => $link) {
            $label = array_get($link, 0);
            $url = array_get($link, 1);
            $active = array_get($link, 2);
            $disabled = array_get($link, 3);
            $items = array_get($link, 4);
            $icon = array_get($link, 5);
            $l[] = static::link($label, $url, $active, $disabled, static::links($items), $icon);
        }

        return $l;
    }
}
