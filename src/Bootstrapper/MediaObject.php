<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\MediaObjectException;

class MediaObject
{

    private $contents = [];
    private $list;

    public function render()
    {
        if($this->list) {
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
        foreach($this->contents as $item) {
            $string .= $this->renderItem($item, 'li');
        }
        $string .= "</ul>";

        return $string;
    }

    private function renderItem($contents, $tag)
    {
        $position = isset($contents['position']) && $contents['position'] == 'right' ? 'pull-right' : 'pull-left';
        return "<{$tag} class='media'><a href='{$contents['link']}' class='{$position}'><img class='media-object' src='{$contents['image']}' alt='{$contents['heading']}'></a><div class='media-body'><h4 class='media-heading'>{$contents['heading']}</h4>{$contents['body']}</div></{$tag}>";
    }
}
