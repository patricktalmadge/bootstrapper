<?php

namespace Bootstrapper;

class ButtonGroup extends RenderedObject
{

    private $contents = [];
    private $buttonType = 'radio';
    private $size;

    const LARGE = 'btn-group-lg';
    const SMALL = 'btn-group-sm';
    const EXTRA_SMALL = 'btn-group-xs';

    const NORMAL = 'btn-default';
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';

    public function render()
    {
        $attributes = new Attributes(['class' => "button-group {$this->size}", 'data-toggle' => 'buttons']);
        $string = "<div {$attributes}>";
        foreach ($this->contents as $item) {
            $item['type'] = isset($item['type']) ? $item['type'] : 'btn-default';
            $string .= "<label class='btn {$item['type']}'><input type='{$this->buttonType}'>{$item['contents']}</label>";
        }
        $string .= "</div>";

        return $string;
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function asType($type)
    {
        $this->buttonType = $type;

        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function large()
    {
        $this->setSize(ButtonGroup::LARGE);

        return $this;
    }

    public function small()
    {
        $this->setSize(ButtonGroup::SMALL);

        return $this;
    }

    public function extraSmall()
    {
        $this->setSize(ButtonGroup::EXTRA_SMALL);

        return $this;
    }
}
