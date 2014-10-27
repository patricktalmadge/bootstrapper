<?php
/**
 * Bootstrapper Thumbnail class
 */

namespace Bootstrapper;

use Bootstrapper\Exceptions\ThumbnailException;

/**
 * Creates Bootstrap 3 compliant Thumbnail
 *
 * @package Bootstrapper
 */
class Thumbnail extends RenderedObject
{

    /**
     * @var array The image
     */
    protected $image;

    /**
     * @var string The caption
     */
    protected $caption;

    /**
     * Renders the thumbnail
     *
     * @return string
     * @throws ThumbnailException if the image is not specified
     */
    public function render()
    {
        if (!isset($this->image['image'])) {
            throw ThumbnailException::imageNotSpecified();
        }

        $attributes = new Attributes(
            $this->attributes,
            ['class' => 'thumbnail']
        );

        $string = "<div {$attributes}>";
        $string .= $this->renderImage();

        if ($this->caption) {
            $string .= $this->renderCaption();
        }
        $string .= '</div>';

        return $string;
    }

    /**
     * Sets the image for the thumbnail
     *
     * @param string $image      The image source
     * @param array  $attributes The attributes
     * @return $this
     */
    public function image($image, $attributes = [])
    {
        $this->image = compact('image', 'attributes');

        return $this;
    }

    /**
     * Sets the caption for the thumbnail
     *
     * @param string $caption The new caption
     * @return $this
     */
    public function caption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Renders the image
     *
     * @return string
     */
    protected function renderImage()
    {
        $attributes = new Attributes(
            $this->image['attributes'],
            ['src' => $this->image['image']]
        );
        return "<img {$attributes}>";
    }

    /**
     * Renders the caption
     *
     * @return string
     */
    protected function renderCaption()
    {
        return "<div class='caption'>{$this->caption}</div>";
    }
}
