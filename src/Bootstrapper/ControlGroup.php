<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ControlGroupException;

class ControlGroup extends RenderedObject
{

    private $attributes = [];
    private $contents = [];
    private $label;
    private $labelSize;
    private $help;

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => 'form-group']);
        $string = "<div {$attributes}>";

        if ($this->label) {
            $contentSize = 12 - $this->labelSize;

            $string .= "<div class='col-sm-{$this->labelSize}'>{$this->label}</div>";
            $string .= "<div class='col-sm-{$contentSize}'>";
        }


        foreach ($this->contents as $item) {
            $string .= $item;
        }

        $string .= $this->help;

        if ($this->label) {
            $string .= "</div>";
        }

        $string .= "</div>";

        return $string;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function withContents($contents)
    {
        $this->contents = (array)$contents;

        return $this;
    }

    public function withLabel($label, $labelSize = 2)
    {
        if ($labelSize < 1 || $labelSize > 11) {
            throw new ControlGroupException('That label size is incorrect - it must be between 1 and 12');
        }

        $this->label = $label;
        $this->labelSize = $labelSize;

        return $this;
    }

    public function withHelp($help)
    {
        $this->help = $help;

        return $this;
    }

    public function generate($label, $control, $help = null, $labelSize = 2)
    {
        return $this->withLabel($label, $labelSize)->withContents($control)->withHelp($help);
    }
}
