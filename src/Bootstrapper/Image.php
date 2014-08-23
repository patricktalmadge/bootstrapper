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

    public function rounded($src = null, $alt = null)
    {
        $this->addClass(self::IMAGE_ROUNDED);

        if (!isset($src))
        {
            $src = $this->src;
        }
        if (!isset($alt))
        {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    public function circle($src = null, $alt = null)
    {
        $this->addClass(self::IMAGE_CIRCLE);

        if (!isset($src))
        {
            $src = $this->src;
        }
        if (!isset($alt))
        {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    public function thumbnail($src = null, $alt = null)
    {
        $this->addClass(self::IMAGE_THUMBNAIL);

        if (!isset($src))
        {
            $src = $this->src;
        }
        if (!isset($alt))
        {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    public function addClass($class)
    {
        $this->attributes['class'] = isset($this->attributes['class']) ? $this->attributes['class'] . " {$class}" : $class;
    }

}
