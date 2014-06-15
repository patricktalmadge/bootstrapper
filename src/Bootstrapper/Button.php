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

    public function setType($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        $attributes = new Attributes(['type' => 'button', 'class' => "btn {$this->type}"]);

        return "<button {$attributes}></button>";
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
}
