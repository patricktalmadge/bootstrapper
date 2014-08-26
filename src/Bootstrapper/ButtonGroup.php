<?php

namespace Bootstrapper;

class ButtonGroup extends RenderedObject
{

    private $contents = [];
    private $type = 'button';
    private $vertical = false;
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

    const RADIO = 'radio';
    const CHECKBOX = 'checkbox';

    public function render()
    {
        $attributes = new Attributes(
            [
                'class' => $this->vertical ? 'btn-group-vertical' : 'btn-group',
                'data-toggle' => 'buttons'
            ]
        );

        if ($this->size) {
            $attributes->addClass($this->size);
        }

        $contents = $this->renderContents();

        return "<div {$attributes}>{$contents}</div>";
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }

    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }

    public function extraSmall()
    {
        $this->setSize(self::EXTRA_SMALL);

        return $this;
    }

    public function radio(array $contents)
    {
        return $this->asType(self::RADIO)->withContents($contents);
    }

    public function checkbox(array $contents)
    {
        return $this->asType(self::CHECKBOX)->withContents($contents);
    }

    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function vertical()
    {
        $this->vertical = true;

        return $this;
    }

    public function asType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function renderContents()
    {
        $contents = '';

        if ($this->type == 'button') {
            foreach ($this->contents as $item) {
                $contents .= $item;
            }
        } else {
            foreach ($this->contents as $item) {
                if ($item instanceof Button)
                {
                    $class = $item->getType();
                    $value = $item->getValue();
                    $contents .= "<label class='btn {$class}'><input type='{$this->type}'>{$value}</label>";
                }
                else
                {
                    $contents .= $item;
                }
            }
        }

        return $contents;
    }


}
