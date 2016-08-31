<?php
/**
 * Bootstrapper Media Object class
 */

namespace Bootstrapper;

use Bootstrapper\Exceptions\MediaObjectException;

/**
 * Creates Bootstrap 3 compliant Media Objects
 *
 * @package Bootstrapper
 */
class MediaObject extends RenderedObject
{

    /**
     * @var array The contents of the media object
     */
    protected $contents = [];

    /**
     * @var bool Whether the list
     */
    protected $list;

    /**
     * Renders the media object
     *
     * @return string
     * @throws MediaObjectException if there is no contents
     */
    public function render()
    {
        if ($this->list) {
            return $this->renderList();
        }

        if (!$this->contents) {
            throw new MediaObjectException(
                "You need to give the object some contents"
            );
        }

        return $this->renderItem($this->contents, 'div');
    }

    /**
     * Sets the contents of the media object
     *
     * @param array $contents The contents of the media object
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        // Check if it's an array of arrays
        $this->list = isset($contents[0]);

        return $this;
    }

    /**
     * Force the media object to become a list
     *
     * @return $this
     */
    public function asList()
    {
        $this->list = true;

        return $this;
    }

    /**
     * Renders a list
     *
     * @return string
     */
    protected function renderList()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => 'media-list']
        );

        $this->attributes = [];

        $string = "<ul {$attributes}>";
        foreach ($this->contents as $item) {
            $string .= $this->renderItem($item, 'li');
        }
        $string .= "</ul>";

        return $string;
    }

    /**
     * Renders an item in the string
     *
     * @param array  $contents
     * @param string $tag The tag to wrap the item in
     * @return string
     * @throws MediaObjectException
     */
    protected function renderItem(array $contents, $tag)
    {
        $position = $this->getPosition($contents);
        $heading = $this->getHeading($contents);
        $image = $this->getImage($contents, $heading);
        $link = $this->getLink($contents, $image, $position);
        $body = $this->getBody($contents);

        $attributes = new Attributes($this->attributes, ['class' => 'media']);

        $string = "<{$tag} {$attributes}>";
        $string .= $link;
        $string .= "<div class='media-body'>";

        if ($heading) {
            $string .= "<h4 class='media-heading'>{$heading}</h4>";
        }

        $string .= $body;
        $string .= "</div></{$tag}>";

        return $string;
    }

    /**
     * Get the position
     *
     * @param array $contents
     * @return string pull-right if the position key equals right. pull-left
     * otherwise
     */
    protected function getPosition(array $contents)
    {
        if (isset($contents['position']) && $contents['position'] == 'right') {
            return 'pull-right';
        }

        return 'pull-left';
    }

    /**
     * Get the image of the media object
     *
     * @param array  $contents
     * @param string $alt The alt text of the image
     * @return string
     * @throws MediaObjectException if there is no image set
     */
    protected function getImage(array $contents, $alt)
    {
        if (!isset($contents['image'])) {
            throw new MediaObjectException(
                "You must pass in an image to each object"
            );
        }
        $image = $contents['image'];

        $attributes = new Attributes(
            ['class' => 'media-object', 'src' => $image, 'alt' => $alt]
        );

        return "<img {$attributes}>";
    }

    /**
     * Get the heading of the media object
     *
     * @param array $contents
     * @return string
     */
    protected function getHeading(array $contents)
    {
        return isset($contents['heading']) ? $contents['heading'] : '';
    }

    /**
     * Turn the image into a link/div
     *
     * @param array  $contents The contents array
     * @param string $image    The image
     * @param string $position The position
     * @return string
     */
    protected function getLink(array $contents, $image, $position)
    {
        if (isset($contents['link'])) {
            return "<a href='{$contents['link']}' class='{$position}'>{$image}</a>";
        }

        return "<div class='{$position}'>{$image}</div>";
    }

    /**
     * Get the body of the contents array
     *
     * @param array $contents
     * @return string
     * @throws MediaObjectException if the body key has not been set
     */
    protected function getBody(array $contents)
    {
        if (!isset($contents['body'])) {
            throw new MediaObjectException(
                'You must pass in the body to each object'
            );
        }

        $string = $contents['body'];

        if (isset($contents['nest'])) {
            $object = new MediaObject();
            $string .= $object->withContents($contents['nest']);
        }

        return $string;
    }
}
