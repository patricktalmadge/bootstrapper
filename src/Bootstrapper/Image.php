<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ImageException;

class Image extends RenderedObject
{

    const IMAGE_RESPONSIVE = 'img-responsive';
    const IMAGE_ROUNDED = 'img-rounded';
    const IMAGE_CIRCLE = 'img-circle';
    const IMAGE_THUMBNAIL = 'img-thumbnail';
    private $src;
    private $alt = '';
    private $attributes = [];

    public function render()
    {
        if (!$this->src) {
            throw new ImageException("You must specify the source");
        }

        $attributes = new Attributes($this->attributes, ['src' => $this->src, 'alt' => $this->alt]);

        return "<img {$attributes}>";
    }

    public function withSource($source)
    {
        $this->src = $source;

        return $this;
    }

    public function withAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function responsive()
    {
        $this->addClass(self::IMAGE_RESPONSIVE);

        return $this;
    }

    public function rounded()
    {
        $this->addClass(self::IMAGE_ROUNDED);

        return $this;
    }

    public function circle()
    {
        $this->addClass(self::IMAGE_CIRCLE);

        return $this;
    }

    public function thumbnail()
    {
        $this->addClass(self::IMAGE_THUMBNAIL);

        return $this;
    }

    public function addClass($class)
    {
        $this->attributes['class'] = isset($this->attributes['class']) ? $this->attributes['class'] . " {$class}" : $class;
    }
}
