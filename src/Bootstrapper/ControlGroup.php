<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ControlGroupException;

class ControlGroup extends RenderedObject
{

    private $attributes = [];
    private $contents = [];
    private $controlSize;
    private $label;
    private $labelSize;
    private $help;
    /**
     * @var Form
     */
    private $formBuilder;

    public function __construct(Form $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => 'form-group']);
        $string = "<div {$attributes}>";

        if ($this->label)
        {
            $string .= $this->renderLabel();
        }

        if ($this->controlSize)
        {
            $string .= $this->createControlDiv();
        }

        if (is_array($this->contents))
        {
            $string .= $this->renderArrayContents();
        }
        else
        {
            $string .=  $this->contents;
        }

        $string .= $this->help;

        if ($this->controlSize)
        {
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

    public function withContents($contents, $controlSize = null)
    {
        if ($controlSize && ($controlSize < 1 || $controlSize > 12))
        {
            throw new ControlGroupException('That content size is incorrect - it must be between 1 and 12');
        }

        $this->contents = $contents;
        $this->controlSize = $controlSize;

        return $this;
    }

    public function withLabel($label, $labelSize = null)
    {
        if (isset($labelSize) && ($labelSize < 1 || $labelSize > 11))
        {
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

    public function generate($label, $control, $help = null, $labelSize = null, $controlSize = null)
    {
        if (($labelSize && $controlSize) && ($labelSize + $controlSize < 1 || $labelSize + $controlSize > 12))
        {
            throw new ControlGroupException('That label size + control size must be between 1 and 12');
        }

        return $this->withLabel($label, $labelSize)->withContents($control, $controlSize)->withHelp($help);
    }

    private function renderArrayContents()
    {
        $string = '';
        foreach($this->contents as $item)
        {
            if(isset($item['label']))
            {
                $string .= call_user_func_array([$this->formBuilder, 'label'], $item['label']) . ' ';
            }
            $input_args = $item['input'];
            $type = $input_args['type'];
            unset($input_args['type']);
            $string .= call_user_func_array([$this->formBuilder, $type], $input_args);
            $string .= '<br />';
        }

        return $string;
    }

    /**
     * @return string
     */
    public function renderLabel()
    {
        $string = '';

        if ($this->labelSize) {
            $this->controlSize = $this->controlSize ?: 12 - $this->labelSize;

            $this->label = preg_replace(
                "/class=('|\")(.*)('|\")/i",
                sprintf('class=${1}${2} col-sm-%s${3}', $this->labelSize),
                $this->label
            );
        }

        $string .= $this->label;
        return $string;
    }

    /**
     * @return string
     */
    public function createControlDiv()
    {
        return sprintf("<div class='col-sm-%s'>", $this->controlSize);
    }
}
