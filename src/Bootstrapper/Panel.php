<?php

namespace Bootstrapper;

class Panel extends RenderedObject
{

    const PRIMARY = 'panel-primary';
    const SUCCESS = 'panel-success';
    const INFO = 'panel-info';
    const WARNING = 'panel-warning';
    const DANGER = 'panel-danger';
    const NORMAL = 'panel-default';

    private $attributes = [];
    private $type = 'panel-default';
    private $header;
    private $body;
    private $footer;

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "panel {$this->type}"]);
        $string = "<div {$attributes}>";
        if ($this->header) {
            $string .= $this->renderHeader();
        }
        if ($this->body) {
            $string .= $this->renderBody();
        }
        if ($this->footer) {
            $string .= $this->renderFooter();
        }
        $string .= "</div>";

        return $string;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function primary()
    {
        $this->setType(Panel::PRIMARY);

        return $this;
    }

    public function success()
    {
        $this->setType(Panel::SUCCESS);

        return $this;
    }

    public function info()
    {
        $this->setType(Panel::INFO);

        return $this;
    }

    public function warning()
    {
        $this->setType(Panel::WARNING);

        return $this;
    }

    public function danger()
    {
        $this->setType(Panel::DANGER);

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function withHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    private function renderHeader()
    {
        $string = "<div class='panel-heading'>";
        $string .= "<h3 class='panel-title'>{$this->header}</h3>";
        $string .= '</div>';

        return $string;
    }

    public function withBody($body)
    {
        $this->body = $body;

        return $this;
    }

    private function renderBody()
    {
        return "<div class='panel-body'>{$this->body}</div>";
    }

    public function withFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    private function renderFooter()
    {
        return "<div class='panel-footer'>{$this->footer}</div>";
    }

    public function normal()
    {
        $this->setType(self::NORMAL);

        return $this;
    }
}
