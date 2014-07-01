<?php

namespace Bootstrapper;

class Badge extends RenderedObject
{

    private $contents;

    /**
     * @var
     */
    private $attributes;

    public function render()
    {
        $this->attributes['class'] = "badge {$this->attributes['class']}";

        $attributes = new Attributes($this->attributes);

        $string = "<span {$attributes}>{$this->contents}</span>";

        return $string;
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }


    public function withAttributes($attributes)
    {
        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = "";
        }

        $this->attributes = $attributes;

        return $this;
    }
}
