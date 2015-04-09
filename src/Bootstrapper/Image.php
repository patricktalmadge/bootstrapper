<?php
/**
 * Bootstrapper Image class
 */

namespace Bootstrapper;

use Bootstrapper\Exceptions\ImageException;

/**
 * Creates Bootstrap 3 compliant images
 *
 * @package Bootstrapper
 */
class Image extends RenderedObject
{

    /**
     * Constant for responsive image
     */
    const IMAGE_RESPONSIVE = 'img-responsive';

    /**
     * Constant for rounded images
     */
    const IMAGE_ROUNDED = 'img-rounded';

    /**
     * Constant for circle image
     */
    const IMAGE_CIRCLE = 'img-circle';

    /**
     * Constant for thumbnail image
     */
    const IMAGE_THUMBNAIL = 'img-thumbnail';

    /**
     * @var string The image source
     */
    protected $src;

    /**
     * @var string The alt text for the image
     */
    protected $alt = '';

    /**
     * Renders the image
     *
     * @return string
     * @throws ImageException If the image source is not set
     */
    public function render()
    {
        if (!$this->src) {
            throw new ImageException("You must specify the source");
        }

        $attributes = new Attributes(
            $this->attributes,
            ['src' => $this->src, 'alt' => $this->alt]
        );

        return "<img {$attributes}>";
    }

    /**
     * Sets the source of the image
     *
     * @param string $source The source of the image
     * @return $this
     */
    public function withSource($source)
    {
        $this->src = $source;

        return $this;
    }

    /**
     * Sets the alt text of the image
     *
     * @param string $alt The alt text of the image
     * @return $this
     */
    public function withAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Sets the image to be responsive
     *
     * @return $this
     */
    public function responsive()
    {
        $this->addClass([self::IMAGE_RESPONSIVE]);

        return $this;
    }

    /**
     * Creates a rounded image
     *
     * @param null|string $src The source of the image. Pass null to use the
     *                         previous value of the source
     * @param null|string $alt The alt text of the image. Pass null to use
     *                         the previous value
     * @return $this
     */
    public function rounded($src = null, $alt = null)
    {
        $this->addClass([self::IMAGE_ROUNDED]);

        if (!isset($src)) {
            $src = $this->src;
        }
        if (!isset($alt)) {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    /**
     * Creates a circle image
     *
     * @param null|string $src The source of the image. Pass null to use the
     *                         previous value of the source
     * @param null|string $alt The alt text of the image. Pass null to use
     *                         the previous value
     * @return $this
     */
    public function circle($src = null, $alt = null)
    {
        $this->addClass([self::IMAGE_CIRCLE]);

        if (!isset($src)) {
            $src = $this->src;
        }
        if (!isset($alt)) {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    /**
     * Creates a thumbnail image
     *
     * @param null|string $src The source of the image. Pass null to use the
     *                         previous value of the source
     * @param null|string $alt The alt text of the image. Pass null to use
     *                         the previous value
     * @return $this
     */
    public function thumbnail($src = null, $alt = null)
    {
        $this->addClass([self::IMAGE_THUMBNAIL]);

        if (!isset($src)) {
            $src = $this->src;
        }
        if (!isset($alt)) {
            $alt = $this->alt;
        }

        return $this->withSource($src)->withAlt($alt);
    }

    /**
     * BC version of Image::addClass()
     *
     * @param string|array $class
     * @return $this
     */
    public function addClass($class)
    {
        if (is_string($class)) {
            trigger_error(
                'Passing strings to Image::getClass ' .
                'is depreciated, and will be removed in a future version of ' .
                'Bootstrapper',
                E_USER_DEPRECATED
            );
            $class = [$class];
        }

        return parent::addClass($class);
    }
}
