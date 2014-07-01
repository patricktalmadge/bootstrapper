<?php

namespace Bootstrapper;


use Illuminate\Routing\UrlGenerator;

class Navbar
{

    private $brand;
    /**
     * @var UrlGenerator
     */
    private $url;
    private $attributes = [];

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class'=>'navbar navbar-default', 'role'=>'navigation']);

        $string = "<nav {$attributes}><div class='container-fluid'>";
        $string .= $this->renderHeader();
        $string .= $this->renderContent();
        $string .= "</div></nav>";

        return $string;
    }

    private function renderContent()
    {
        return "<div class='navbar-collapse collapse'></div>";
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

    public function __toString()
    {
        return $this->render();
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
}
