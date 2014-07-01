<?php

namespace Bootstrapper;

class Button extends RenderedObject
{

    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';
    const LINK = 'btn-link';
    const LARGE = 'btn-lg';
    const SMALL = 'btn-sm';
    const EXTRA_SMALL = 'btn-xs';

    private $type = 'btn-default';
    private $block = false;
    private $attributes = [];
    private $value = '';
    private $icon;
    private $size;

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['type' => 'button', 'class' => "btn {$this->type}"]);

        if ($this->size) {
            $attributes['class'] .= " {$this->size}";
        }

        if ($this->block) {
            $attributes['class'] .= ' btn-block';
        }

        if ($this->icon) {
            $icon = "<span class='glyphicon glyphicon-{$this->icon}'></span>";
            $this->value .= $this->value ? " {$icon}" : $icon;
        }

        return "<button {$attributes}>{$this->value}</button>";
    }

    public function primary()
    {
        $this->setType(Button::PRIMARY);

        return $this;
    }

    public function success()
    {
        $this->setType(Button::SUCCESS);

        return $this;
    }

    public function info()
    {
        $this->setType(Button::INFO);

        return $this;
    }

    public function warning()
    {
        $this->setType(Button::WARNING);

        return $this;
    }

    public function danger()
    {
        $this->setType(Button::DANGER);

        return $this;
    }

    public function link()
    {
        $this->setType(Button::LINK);

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function block()
    {
        $this->block = true;

        return $this;
    }

    public function submit()
    {
        $this->attributes['type'] = 'submit';

        return $this;
    }

    public function reset()
    {
        $this->attributes['type'] = 'reset';

        return $this;
    }

    public function withValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function withIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function large()
    {
        $this->setSize(Button::LARGE);

        return $this;
    }

    public function small()
    {
        $this->setSize(Button::SMALL);

        return $this;
    }

    public function extraSmall()
    {
        $this->setSize(Button::EXTRA_SMALL);

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function addAttributes($attributes)
    {
        $this->attributes = array_merge($attributes, $this->attributes);

        return $this;
    }
}
