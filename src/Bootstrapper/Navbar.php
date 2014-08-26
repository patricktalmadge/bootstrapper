<?php

namespace Bootstrapper;


use Illuminate\Routing\UrlGenerator;

class Navbar extends RenderedObject
{

    const NAVBAR_INVERSE = 'navbar-inverse';
    const NAVBAR_STATIC = 'navbar-static-top';
    const NAVBAR_TOP = 'navbar-fixed-top';
    const NAVBAR_BOTTOM = 'navbar-fixed-bottom';

    private $brand;
    /**
     * @var UrlGenerator
     */
    private $url;
    private $attributes = [];
    private $content = [];
    private $type = 'navbar-default';
    private $position;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "navbar {$this->type} {$this->position}", 'role' => 'navigation']);

        $string = "<div {$attributes}><div class='container'>";
        $string .= $this->renderHeader();
        $string .= $this->renderContent();
        $string .= "</div></div>";

        return $string;
    }

    private function renderContent()
    {
        $string = "<nav class='navbar-collapse collapse'>";
        foreach ($this->content as $item) {
            if (is_a($item, 'Bootstrapper\\Navigation')) {
                $item->navbar();
            }
            $string .= $item;
        }

        $string .= "</nav>";

        return $string;
    }

    private function renderHeader()
    {
        $string = "<div class='navbar-header'>";
        // Add the collapse button
        $string .= "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>";
        if ($this->brand) {
            $string .= "<a class='navbar-brand' href='{$this->brand['link']}'>{$this->brand['brand']}</a>";
        }
        $string .= "</div>";

        return $string;
    }

    public function withBrand($brand, $link = null)
    {
        if (!isset($link)) {
            $link = $this->url->to('/');
        }

        $this->brand = compact('brand', 'link');

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function withContent($content)
    {
        $this->content[] = $content;

        return $this;
    }

    public function inverse()
    {
        $this->setType(self::NAVBAR_INVERSE);

        return $this;
    }

    public function staticTop()
    {
        $this->setPosition(self::NAVBAR_STATIC);

        return $this;
    }

    public  function setType($type)
    {
        $this->type = $type;
    }

    public  function setPosition($position)
    {
        $this->position = $position;
    }

    public function top()
    {
        $this->setPosition(self::NAVBAR_TOP);

        return $this;
    }

    public function bottom()
    {
        $this->setPosition(self::NAVBAR_BOTTOM);

        return $this;
    }

    public function create($position, $attributes = [])
    {
        $this->setPosition($position);

        return $this->withAttributes($attributes);
    }
}
