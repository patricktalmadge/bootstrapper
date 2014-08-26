<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\MediaObjectException;

class MediaObject extends RenderedObject
{

    private $contents = [];
    private $list;

    public function render()
    {
        if ($this->list) {
            return $this->renderList();
        }

        if (!$this->contents) {
            throw new MediaObjectException("You need to give the object some contents");
        }

        return $this->renderItem($this->contents, 'div');
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        // Check if it's an array of arrays
        $this->list = !(isset($contents['image']));

        return $this;
    }

    public function asList()
    {
        $this->list = true;

        return $this;
    }

    private function renderList()
    {
        $string = "<ul class='media-list'>";
        foreach ($this->contents as $item) {
            $string .= $this->renderItem($item, 'li');
        }
        $string .= "</ul>";

        return $string;
    }

    private function renderItem($contents, $tag)
    {
        $position = $this->getPosition($contents);
        $heading = $this->getHeading($contents);
        $image = $this->getImage($contents, $heading);
        $link = $this->getLink($contents, $image, $position);
        $body = $this->getBody($contents);

        $string = "<{$tag} class='media'>";
        $string .= $link;
        $string .= "<div class='media-body'>";

        if ($heading) {
            $string .= "<h4 class='media-heading'>{$heading}</h4>";
        }

        $string .= $body;
        $string .= "</div></{$tag}>";

        return $string;
    }

    private function getPosition($contents)
    {
        if (isset($contents['position']) && $contents['position'] == 'right') {
            return 'pull-right';
        }

        return 'pull-left';

    }

    private function getImage($contents, $alt)
    {
        if (!isset($contents['image'])) {
            throw new MediaObjectException("You must pass in an image to each object");
        }
        $image = $contents['image'];

        $attributes = new Attributes(['class' => 'media-object', 'src' => $image, 'alt' => $alt]);

        return "<img {$attributes}>";
    }

    private function getHeading($contents)
    {
        return isset($contents['heading']) ? $contents['heading'] : '';
    }

    private function getLink($contents, $image, $position)
    {
        if (isset($contents['link'])) {
            return "<a href='{$contents['link']}' class='{$position}'>{$image}</a>";
        }

        return "<div class='{$position}'>{$image}</div>";
    }

    private function getBody($contents)
    {
        if (!isset($contents['body'])) {
            throw new MediaObjectException('You must pass in the body to each object');
        }

        $string = $contents['body'];

        if (isset($contents['nest']))
        {
            $object = new MediaObject();
            $string.= $object->withContents($contents['nest']);
        }

        return $string;
    }
}
