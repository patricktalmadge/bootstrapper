<?php

namespace Bootstrapper;

use Illuminate\Routing\UrlGenerator;

class Navigation extends RenderedObject
{

    const NAVIGATION_PILLS = 'nav-pills';
    const NAVIGATION_TABS = 'nav-tabs';
    private $attributes = [];
    private $type = 'nav-tabs';
    private $links = [];
    /**
     * @var UrlGenerator
     */
    private $url;
    private $autoroute = true;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "nav {$this->type}"]);
        $string = "<ul {$attributes}>";
        foreach ($this->links as $link) {
            $string .= $this->renderLink($link);
        }

        $string .= "</ul>";

        return $string;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function pills($links = [])
    {
        $this->type = self::NAVIGATION_PILLS;

        return $this->links($links);
    }

    public function links($links)
    {
        $this->links = $links;

        return $this;
    }

    public function tabs($links = [])
    {
        $this->type = self::NAVIGATION_TABS;

        return $this->links($links);
    }

    /**
     * @param $link
     * @return string
     */
    private function renderLink($link)
    {
        $string = '';
        if ($this->autoroute && $this->url->current() == $link['link']) {
            $string .= '<li class=\'active\'>';
        } else {
            $string .= '<li>';
        }
        $string .= "<a href='{$link['link']}'>{$link['title']}</a></li>";

        return $string;
    }

    public function autoroute($autoroute)
    {
        $this->autoroute = $autoroute;

        return $this;
    }

    public function grouped($argument1)
    {
        // TODO: write logic here
    }
}
