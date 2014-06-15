<?php

namespace Bootstrapper;

class Button
{

    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';
    const LINK = 'btn-link';

    private $type = 'btn-default';
    private $block = false;
    private $attributes = [];
    private $value = '';

    public function setType($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['type' => 'button', 'class' => "btn {$this->type}"]);

        if ($this->block) {
            $attributes['class'] .= ' btn-block';
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
}
