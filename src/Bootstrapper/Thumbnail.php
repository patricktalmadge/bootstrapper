<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ThumbnailException;

class Thumbnail extends RenderedObject
{

    protected $image;
    protected $caption;

    public function render()
    {
        if(!isset($this->image['image'])) {
            throw new ThumbnailException('You must specify the image');
        }
        $string = '<div class=\'thumbnail\'>';
        $string .= $this->renderImage();
        if ($this->caption) {
            $string .= $this->renderCaption();
        }
        $string .= '</div>';

        return $string;
    }

    public function image($image, $attributes = [])
    {
        $this->image = compact('image', 'attributes');

        return $this;
    }

    public function caption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    protected function renderImage()
    {
        $attributes = new Attributes($this->image['attributes'], ['src' => $this->image['image']]);
        return "<img {$attributes}>";
    }

    protected function renderCaption()
    {
        $string = '<div class=\'caption\'>';
        $string .= $this->caption;
        $string .= '</div>';

        return $string;
    }
}
