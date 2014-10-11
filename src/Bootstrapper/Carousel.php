<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\CarouselException;

/**
 * Creates Bootstrap 3 compliant carousels
 *
 * @package Bootstrapper
 */
class Carousel extends RenderedObject
{

    /**
     * @var string The name of the carousel
     */
    protected $name;

    /**
     * @var array The contents of the carousel. Should be an array of arrays,
     * with the inner arrays having the following keys:
     * <dl><dt>image</dt><dd>A path to the image</dd> <dt>alt</dt><dd>The alt
     * text for the image</dd> <dt>caption (optional)</dt><dd>The caption for
     * that slide</dd></dl>

     */
    protected $contents = [];

    /**
     * @var array The attributes of the carousel
     */
    protected $attributes = [];

    /**
     * @var int Which slide should be active at the beginning
     */
    protected $active = 0;

    /**
     * Names the carousel
     *
     * @param string $name The name of the carousel
     * @return $this
     */
    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Sets the attributes of the carousel
     *
     * @param array $attributes The new attributes
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Sets the contents of the carousel
     *
     * @param array $contents The new contents. Should be an array of arrays,
     *                        with the inner keys being "image", "alt" and
     *                        (optionally) "caption"
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Renders the carousel
     *
     * @return string
     * @throws \Bootstrapper\Exceptions\CarouselException Thrown if the
     * carousel has not been named
     */
    public function render()
    {
        if (!$this->name) {
            throw new CarouselException("You haven't named the carousel");
        }

        $attributes = new Attributes(
            $this->attributes,
            [
                'id' => $this->name,
                'class' => 'carousel slide',
                'data-ride' => 'carousel'
            ]
        );

        $string = "<div {$attributes}>";
        $string .= $this->renderIndicators();
        $string .= $this->renderItems();
        $string .= $this->renderControls();
        $string .= "</div>";

        return $string;
    }

    /**
     * Renders the indicators
     *
     * @return string
     */
    protected function renderIndicators()
    {
        $string = "<ol class='carousel-indicators'>";
        for ($i = 0; $i < count($this->contents); $i++) {
            if ($i == $this->active) {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}' class='active'></li>";
            } else {
                $string .= "<li data-target='#{$this->name}' data-slide-to='{$i}'></li>";
            }
        }
        $string .= "</ol>";

        return $string;
    }

    /**
     * Renders the items of the carousel
     *
     * @return string
     */
    protected function renderItems()
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

    /**
     * Renders the controls of the carousel
     *
     * @return string
     */
    protected function renderControls()
    {
        return "<a class='left carousel-control' href='#{$this->name}' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#{$this->name}' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>";
    }

}
