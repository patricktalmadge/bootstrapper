<?php

namespace Bootstrapper;

class DropdownButton extends RenderedObject
{
    const DIVIDER = "<li class='divider'></li>";

    const PRIMARY = 'btn-primary';
    const DANGER = 'btn-danger';
    const WARNING = 'btn-warning';
    const SUCCESS = 'btn-success';
    const NORMAL = 'btn-default';

    const INFO = 'btn-info';
    const LARGE = 'btn-lg';
    const SMALL = 'btn-sm';
    const EXTRA_SMALL = 'btn-xs';

    private $label;
    private $contents = [];
    private $type = 'btn-default';
    private $size;
    private $split = false;
    private $dropup = false;

    public function labelled($label)
    {
        $this->label = $label;

        return $this;
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function split()
    {
        $this->split = true;

        return $this;
    }

    public function dropup()
    {
        $this->dropup = true;

        return $this;
    }

    public function normal($label = '')
    {
        $this->setType(self::NORMAL);

        return $this->labelled($label);
    }

    public function primary($label = '')
    {
        $this->setType(DropdownButton::PRIMARY);

        return $this->labelled($label);
    }

    public function danger($label = '')
    {
        $this->setType(DropdownButton::DANGER);

        return $this->labelled($label);
    }

    public function warning($label = '')
    {
        $this->setType(DropdownButton::WARNING);

        return $this->labelled($label);
    }

    public function success($label = '')
    {
        $this->setType(DropdownButton::SUCCESS);

        return $this->labelled($label);
    }

    public function info($label = '')
    {
        $this->setType(DropdownButton::INFO);

        return $this->labelled($label);
    }

    public function large()
    {
        $this->setSize(DropdownButton::LARGE);

        return $this;
    }


    public function small()
    {
        $this->setSize(DropdownButton::SMALL);

        return $this;
    }

    public function extraSmall()
    {
        $this->setSize(DropdownButton::EXTRA_SMALL);

        return $this;
    }

    public function render()
    {
        if ($this->dropup) {
            $string = "<div class='btn-group dropup'>";
        } else {
            $string = "<div class='btn-group'>";
        }
        $attributes = new Attributes(
            ['class' => "btn {$this->type} dropdown-toggle", 'data-toggle' => 'dropdown', 'type' => 'button']
        );
        if ($this->size) {
            $attributes['class'] .= " {$this->size}";
        }
        if ($this->split) {
            $splitAttributes = new Attributes(['class' => $attributes['class'], 'type' => 'button']);
            $splitAttributes['class'] = str_replace(' dropdown-toggle', '', $splitAttributes['class']);
            $string .= "<button {$splitAttributes}>{$this->label}</button>";
            $string .= "<button {$attributes}><span class='caret'></span></button>";
        } else
        {
            $string .= "<button {$attributes}>{$this->label} <span class='caret'></span></button>";
        }
        $string .= "<ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>";
        $string .= $this->renderItems();
        $string .= "</ul>";
        $string .= "</div>";

        return $string;
    }

    private function renderItems()
    {
        $string = "";
        foreach ($this->contents as $item) {
            if (is_array($item)) {
                $string .= "<li><a href='{$item['url']}'>{$item['label']}</a></li>";
            } else {
                $string .= $item;
            }
        }

        return $string;
    }
}
