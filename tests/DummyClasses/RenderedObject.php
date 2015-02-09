<?php

namespace DummyClasses;

use Bootstrapper\Attributes;

class RenderedObject extends \Bootstrapper\RenderedObject
{
    /**
     * Renders the object
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes($this->attributes);
        return "<tmp {$attributes}>";
    }

}
