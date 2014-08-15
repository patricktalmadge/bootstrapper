<?php

namespace Bootstrapper;

class Button extends RenderedObject
{

    const NORMAL = 'btn-default';
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
    private $disabled;
    private $appendIcon;
    private $url;

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
        $defaults = ['type' => 'button', 'class' => "btn {$this->type}"];

        if ($this->url)
        {
            unset($defaults['type']);
        }

        $attributes = new Attributes($this->attributes, $defaults);

        if ($this->size) {
            $attributes['class'] .= " {$this->size}";
        }

        if ($this->block) {
            $attributes['class'] .= ' btn-block';
        }

        if ($this->icon) {
            if ($this->appendIcon)
            {
                $this->value .= $this->value ? " {$this->icon}" : $this->icon;
            }
            else
            {
                $this->value = $this->value ? "{$this->icon} {$this->value}" : $this->icon;
            }
        }

        if ($this->disabled)
        {
            $attributes['disabled'] = 'disabled';
        }

        if ($this->url)
        {
            $attributes['href'] = $this->url;
        }

        $tag = $this->url ? 'a' : 'button';

        return "<{$tag} {$attributes}>{$this->value}</{$tag}>";
    }

    public function normal($contents = '')
    {
        $this->setType(self::NORMAL);

        return $this->withValue($contents);
    }

    public function primary($contents = '')
    {
        $this->setType(self::PRIMARY);

        return $this->withValue($contents);
    }

    public function success($contents = '')
    {
        $this->setType(self::SUCCESS);

        return $this->withValue($contents);
    }

    public function info($contents = '')
    {
        $this->setType(self::INFO);

        return $this->withValue($contents);
    }

    public function warning($contents = '')
    {
        $this->setType(self::WARNING);

        return $this->withValue($contents);
    }

    public function danger($contents = '')
    {
        $this->setType(self::DANGER);

        return $this->withValue($contents);
    }

    public function link($contents = '')
    {
        $this->setType(self::LINK);

        return $this->withValue($contents);
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

    public function disable()
    {
        $this->disabled = true;

        return $this;
    }

    public function withIcon($icon, $append = true)
    {
        $this->icon = $icon;
        $this->appendIcon = $append;

        return $this;
    }

    public function appendIcon($icon)
    {
        return $this->withIcon($icon, true);
    }

    public function prependIcon($icon)
    {
        return $this->withIcon($icon, false);
    }

    public function asLinkTo($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }
}
