<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ModalException;

class Modal extends RenderedObject
{

    private $attributes = [];
    private $title;
    private $body;
    private $footer;
    private $name;
    private $button;

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => 'modal']);

        $string = $this->renderButton($attributes);

        $string .= "<div {$attributes}><div class='modal-dialog'><div class='modal-content'>";

        $string .= $this->renderHeader();
        $string .= $this->renderBody();
        $string .= $this->renderFooter();

        $string .= "</div></div></div>";

        return $string;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }


    public function withTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    private function renderHeader()
    {
        $title = '';
        if ($this->title) {
            $title .= "<h4 class='modal-title'>{$this->title}</h4>";
        }

        return "<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>{$title}</div>";
    }

    public function withBody($body)
    {
        $this->body = $body;

        return $this;
    }

    private function renderBody()
    {
        return $this->body ? "<div class='modal-body'>{$this->body}</div>" : '';
    }

    private function renderFooter()
    {
        return $this->footer ? "<div class='modal-footer'>{$this->footer}</div>" : '';
    }

    public function withFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    public function named($name)
    {
        $this->name = $name;
        $this->attributes['id'] = $name;

        return $this;
    }

    public function withButton(Button $button = null)
    {
        if ($button) {
            $this->button = $button;
        } else {
            $button = new Button();

            $this->button = $button->withValue('Open Modal');
        }

        return $this;
    }

    private function renderButton(Attributes $attributes)
    {
        if (!$this->button) {
            return '';
        }

        if (!isset($attributes['id'])) {
            throw new ModalException("You must give the modal an id either using withAttributes() or named()");
        }

        $this->button->addAttributes(['data-toggle' => 'modal', 'data-target' => "#{$attributes['id']}"])->render();

        return $this->button->render();
    }
}
