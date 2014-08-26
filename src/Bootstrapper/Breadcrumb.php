<?php

namespace Bootstrapper;

class Breadcrumb extends RenderedObject
{
    private $links = [];

    public function render()
    {
        $string = "<ol class='breadcrumb'>";
        foreach ($this->links as $text => $link) {
            $string .= $this->renderLink($text, $link);
        }
        $string .= "</ol>";

        return $string;
    }

    public function withLinks($links)
    {

        $this->links = $links;

        return $this;
    }

    private function renderLink($text, $link)
    {
        $string = "";
        if (is_string($text)) {
            $string .= "<li>";
            $string .= "<a href='{$link}'>{$text}</a>";
        } else {
            $string .= "<li class='active'>";
            $string .= $link;
        }
        $string .= "</li>";

        return $string;
    }
}
