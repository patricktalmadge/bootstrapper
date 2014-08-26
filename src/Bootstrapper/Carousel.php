<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\CarouselException;

class Carousel extends RenderedObject
{

    private $name;
    private $contents = [];
    private $attributes = [];
    private $active = 0;

    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function render()
    {
        if (!$this->name) {
            throw new CarouselException("You haven't named the carousel");
        }

        $attributes = new Attributes(
            $this->attributes,
            ['id' => $this->name, 'class' => 'carousel slide', 'data-ride' => 'carousel']
        );

        $string = "<div {$attributes}>";
        $string .= $this->renderIndicators();
        $string .= $this->renderItems();
        $string .= $this->renderControls();
        $string .= "</div>";

        return $string;
    }

    private function renderIndicators()
    {
        $string = "<ol class='carousel-indicators'>";
        for ($i = 0; $i < count($this->contents); $i++) {
            if ($i == $this->active)
            {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}' class='active'></li>";
            }
            else
            {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}'></li>";
            }
        }
        $string .= "</ol>";

        return $string;
    }

    private function renderItems()
    {
        $string = "<div class='carousel-inner'>";
        $count = 0;
        foreach ($this->contents as $item) {
            if ($count == $this->active) {
                $string .= "<div class='item active'>";
            } else {
                $string .= "<div class='item'>";
            }
            $string .= "<img src='{$item['image']}' alt='{$item['alt']}'>";
            if (isset($item['caption'])) {
                $string .= "<div class='carousel-caption'>{$item['caption']}</div>";
            }
            $string .= "</div>";
            $count++;
        }
        $string .= "</div>";

        return $string;
    }

    private function renderControls()
    {
        return "<a class='left carousel-control' href='#{$this->name}' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#{$this->name}' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>";
    }

}
