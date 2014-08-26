<?php

namespace Bootstrapper;

class InputGroup extends RenderedObject
{

    const LARGE = 'input-group-lg';
    const SMALL = 'input-group-sm';

    private $size = '';
    private $append;
    private $prepend;
    private $contents;
    private $attributes = [];

    public function render()
    {
        $attributes = ['class' => "input-group {$this->size}"];
        $attributes = new Attributes($this->attributes, $attributes);

        $string = "<div {$attributes}>";
        if (is_array($this->prepend)) {
            $string .= $this->renderAddon($this->prepend);
        }

        $string .= $this->contents;

        if (is_array($this->append)) {
            $string .= $this->renderAddon($this->append);
        }

        $string .= "</div>";

        return $string;
    }

    private function renderAddon(array $addon)
    {
        $string = "";
        if ($addon['isButton']) {
            $string .= "<span class='input-group-btn'>";
        } else {
            $string .= "<span class='input-group-addon'>";
        }
        $string .= $addon['value'];
        $string .= "</span>";

        return $string;
    }


    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function prepend($prepend, $isButton = false)
    {
        $this->prepend = ['value' => $prepend, 'isButton' => $isButton];

        return $this;
    }

    public function prependButton($button)
    {
        return $this->prepend($button, true);
    }

    public function append($append, $isButton = false)
    {
        $this->append = ['value' => $append, 'isButton' => $isButton];

        return $this;
    }

    public function appendButton($button)
    {
        return $this->append($button, true);
    }

    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }

    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }
}
