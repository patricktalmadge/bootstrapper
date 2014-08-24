<?php

namespace Bootstrapper;

use Illuminate\Routing\UrlGenerator;

class Navigation extends RenderedObject
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    const NAVIGATION_NAVBAR = 'navbar-nav';
    const NAVIGATION_DIVIDER = 'divider';

    private $attributes = [];
    private $type = 'nav-tabs';
    private $links = [];
    /**
     * @var UrlGenerator
     */
    private $url;
    private $autoroute = true;
    private $justified = false;
    private $stacked = false;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "nav {$this->type}"]);
        if ($this->justified) {
            $attributes['class'] .= ' nav-justified';
        }
        if ($this->stacked) {
            $attributes['class'] .= ' nav-stacked';
        }
        $string = "<ul {$attributes}>";
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $string .= $this->renderSeperator($link);
            } elseif (isset($link['link'])) {
                $string .= $this->renderLink($link);
            } else {
                $string .= $this->renderDropdown($link);
            }
        }

        $string .= "</ul>";

        return $string;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function pills($links = [], $attributes = [])
    {
        $this->type = self::NAVIGATION_PILLS;

        if (!$attributes) {
            $attributes = $this->attributes;
        }

        return $this->links($links)->withAttributes($attributes);
    }

    public function links($links)
    {
        $this->links = $links;

        return $this;
    }

    public function tabs($links = [], $attributes = [])
    {
        $this->type = self::NAVIGATION_TABS;
        if (!$attributes) {
            $attributes = $this->attributes;
        }

        return $this->links($links)->withAttributes($attributes);
    }

    /**
     * @param $link
     * @return string
     */
    private function renderLink($link)
    {
        $string = '';
        if ($this->itemShouldBeActive($link)) {
            $string .= '<li class=\'active\'>';
        } elseif (isset($link['disabled']) && $link['disabled']) {
            $string .= '<li class=\'disabled\'>';
        } else {
            $string .= '<li>';
        }
        $linkAttributes = isset($link['linkAttributes']) ? $link['linkAttributes'] : [];
        $linkAttributes = new Attributes($linkAttributes, ['href' => $link['link']]);
        $string .= "<a {$linkAttributes}>{$link['title']}</a></li>";

        return $string;
    }

    public function autoroute($autoroute)
    {
        $this->autoroute = $autoroute;

        return $this;
    }

    private function renderDropdown($link)
    {
        if ($this->dropdownShouldBeActive($link)) {
            $string = '<li class=\'dropdown active\'>';
            // Prevent active state being added to any other links
            $this->autoroute(false);
        } else {
            $string = '<li class=\'dropdown\'>';
        }
        $string .= "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>{$link[0]} <span class='caret'></span></a>";
        $string .= '<ul class=\'dropdown-menu\' role=\'menu\'>';
        foreach ($link[1] as $item) {
            $string .= is_array($item) ? $this->renderLink($item) : $this->renderSeperator($item);
        }
        $string .= '</ul>';
        $string .= '</li>';

        return $string;
    }

    private function dropdownShouldBeActive($dropdown)
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
     * @param $link
     * @return bool
     */
    private function itemShouldBeActive($link)
    {
        if (is_string($link))
        {
            return false;
        }
        $auto = $this->autoroute && $this->url->current() == $link['link'];
        $manual = isset($link['active']) && $link['active'];
        return $auto || $manual;
    }

    public function navbar()
    {
        $this->type = self::NAVIGATION_NAVBAR;

        return $this;
    }

    public function justified()
    {
        $this->justified = true;

        return $this;
    }

    public function stacked()
    {
        $this->stacked = true;

        return $this;
    }

    private function renderSeperator($link)
    {
        return "<li class='{$link}'></li>";
    }
}
