<?php

namespace Bootstrapper;

use Illuminate\Routing\UrlGenerator;

/**
 * Creates Bootstrap 3 compliant navigation
 *
 * @package Bootstrapper
 */
class Navigation extends RenderedObject
{

    /**
     * Constant for navigation pills
     */
    const NAVIGATION_PILLS = 'nav-pills';

    /**
     * Constant for navigation tabs
     */
    const NAVIGATION_TABS = 'nav-tabs';

    /**
     * Constant for navigation elements in the navbar
     */
    const NAVIGATION_NAVBAR = 'navbar-nav';

    /**
     * Constant for navigation dividers
     */
    const NAVIGATION_DIVIDER = 'divider';

    /**
     * @var array The attributes of the navigation element
     */
    protected $attributes = [];

    /**
     * @var string The type
     */
    protected $type = 'nav-tabs';

    /**
     * @var array The links. It should be an array of arrays with the inner
     * array having the following keys:
     * <ul>
     * <li>title - The text to show</li>
     * <li>link - The link</li>
     * <li>active - (optional) Forces the link to be active</li>
     * <li>disabled - (optional) Forces the link to be disabled. Note that
     * active has priority over this</li>
     * <li>linkAttributes - The attributes for the link</li>
     * <li>callback - A callback. If it return a result that is EXACTLY
     * equal to false then the link won't be shown</li>
     * </ul>
     *
     * To create a dropdown, the inner array should instead be [$title, $links],
     * where $links is an array of arrays for links
     */
    protected $links = [];

    /**
     * @var UrlGenerator A laravel URL generator
     */
    protected $url;

    /**
     * @var bool Whether we should automatically activate links
     */
    protected $autoroute = true;

    /**
     * @var bool Whether the links are justified or not
     */
    protected $justified = false;

    /**
     * @var bool Whether the navigation links are stacked or not
     */
    protected $stacked = false;

    /**
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
    }

    /**
     * Renders the navigation object
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => "nav {$this->type}"]
        );

        if ($this->justified) {
            $attributes->addClass('nav-justified');
        }

        if ($this->stacked) {
            $attributes->addClass('nav-stacked');
        }

        $string = "<ul {$attributes}>";

        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $string .= $this->renderSeparator($link);
            } elseif (isset($link['link'])) {
                $string .= $this->renderLink($link);
            } else {
                $string .= $this->renderDropdown($link);
            }
        }

        $string .= "</ul>";

        return $string;
    }

    /**
     * Set the attributes of the navigation object
     *
     * @param array $attributes The attributes
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Creates a pills navigation block
     *
     * @param array $links      The links
     * @param array $attributes The attributes. Does not overwrite the
     *                          previous values if not set
     * @see Bootstrapper\Navigatation::$links
     * @return $this
     */
    public function pills(array $links = [], array $attributes = null)
    {
        $this->type = self::NAVIGATION_PILLS;

        if (!isset($attributes)) {
            $attributes = $this->attributes;
        }

        return $this->links($links)->withAttributes($attributes);
    }

    /**
     * Sets the links of the navigation object
     *
     * @param array $links The links
     * @return $this
     * @see Bootstrapper\Navigation::$links
     */
    public function links(array $links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Creates a navigation tab object.
     *
     * @param array $links      The links to be passed in
     * @param array $attributes The attributes of the navigation object. Will
     *                          overwrite unless not set.
     * @return $this
     */
    public function tabs(array $links = [], array $attributes = null)
    {
        $this->type = self::NAVIGATION_TABS;
        if (!isset($attributes)) {
            $attributes = $this->attributes;
        }

        return $this->links($links)->withAttributes($attributes);
    }

    /**
     * Renders a link
     *
     * @param array $link A link to be rendered
     * @return string
     */
    protected function renderLink(array $link)
    {
        $string = '';

        if (isset($link['callback'])) {
            $callback = $link['callback'];

            if ($callback() === false) {
                return $string;
            }
        }

        if ($this->itemShouldBeActive($link)) {
            $string .= '<li class=\'active\'>';
        } elseif (isset($link['disabled']) && $link['disabled']) {
            $string .= '<li class=\'disabled\'>';
        } else {
            $string .= '<li>';
        }

        $linkAttributes = isset($link['linkAttributes']) ?
            $link['linkAttributes'] :
            [];
        $linkAttributes = new Attributes(
            $linkAttributes,
            ['href' => $link['link']]
        );

        $string .= "<a {$linkAttributes}>{$link['title']}</a></li>";

        return $string;
    }

    /**
     * Sets the autorouting. Pass false to turn it off, true to turn it on
     *
     * @param bool $autoroute Whether the autorouting should be on
     * @return $this
     */
    public function autoroute($autoroute)
    {
        $this->autoroute = $autoroute;

        return $this;
    }

    /**
     * Renders the dropdown
     *
     * @param array $link The link to render
     * @return string
     */
    protected function renderDropdown(array $link)
    {
        if ($this->dropdownShouldBeActive($link)) {
            $string = '<li class=\'dropdown active\'>';
        } else {
            $string = '<li class=\'dropdown\'>';
        }

        $string .= "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>{$link[0]} <span class='caret'></span></a>";
        $string .= '<ul class=\'dropdown-menu\' role=\'menu\'>';

        foreach ($link[1] as $item) {
            // @todo Eerily similar to the check in the render method
            $string .= is_array($item) ?
                $this->renderLink($item) :
                $this->renderSeparator($item);
        }

        $string .= '</ul>';
        $string .= '</li>';

        return $string;
    }

    /**
     * Checks to see if the dropdown should be active
     *
     * @param array $dropdown The dropdown array
     * @return bool
     */
    protected function dropdownShouldBeActive(array $dropdown)
    {
        if ($this->autoroute) {
            foreach ($dropdown[1] as $item) {
                if ($this->itemShouldBeActive($item)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * checks whether an item should be activated or not.
     * If the item is not to be activated via URL::current(), it checks
     * if the item is a dropdown and returns true if any of the children
     * of items have target === URL::current()
     *
     * @param array $item item array
     * @return boolean
     */
    protected static function shouldActivate($item)
    {
        // @todo Rewrite. We can't assume we have access to the URL facade
        if (\URL::current() == $item['url']) {
            return true;
        }

        if (isset($item['items']) and is_array($item['items'])) {
            foreach ($item['items'] as $i) {
                if (static::shouldActivate($i) === true) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks to see if the given item should be active
     *
     * @param mixed $link A link to check whether it should be active
     * @return bool
     */
    protected function itemShouldBeActive($link)
    {
        if (is_string($link)) {
            return false;
        }
        $auto = $this->autoroute && $this->url->current() == $link['link'];
        $manual = isset($link['active']) && $link['active'];
        return $auto || $manual;
    }

    /**
     * Turns the navigation object into one for navbars
     *
     * @return $this
     */
    public function navbar()
    {
        $this->type = self::NAVIGATION_NAVBAR;

        return $this;
    }

    /**
     * Makes the navigation links justified
     *
     * @return $this
     */
    public function justified()
    {
        $this->justified = true;

        return $this;
    }

    /**
     * Makes the navigation stacked
     *
     * @return $this
     */
    public function stacked()
    {
        $this->stacked = true;

        return $this;
    }

    /**
     * Renders a separator
     *
     * @param string $separator
     * @return string
     */
    protected function renderSeparator($separator)
    {
        return "<li class='{$separator}'></li>";
    }
}
