<?php

namespace Bootstrapper;

class Alert extends RenderedObject
{

    const INFO = 'alert-info';
    const SUCCESS = 'alert-success';
    const WARNING = 'alert-warning';
    const DANGER = 'alert-danger';

    private $type;
    private $contents;
    private $isBlock = false;
    private $isCloseable = false;
    private $attributes = [];

    private function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "alert {$this->type}"]);

        if ($this->isBlock) {
            $attributes['class'] = trim($attributes['class']) . ' alert-block';
        }
        if ($this->isCloseable) {
            $attributes['class'] = trim($attributes['class']) . ' alert-dismissable';
            $this->contents = "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>{$this->contents}";
        }

        return "<div {$attributes}>{$this->contents}</div>";
    }

    public function info($contents = '')
    {
        return $this->setType(self::INFO)->withContents($contents);
    }

    public function success($contents = '')
    {
        return $this->setType(self::SUCCESS)->withContents($contents);
    }

    public function warning($contents = '')
    {
        return $this->setType(self::WARNING)->withContents($contents);
    }

    public function danger($contents = '')
    {
        return $this->setType(self::DANGER)->withContents($contents);
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function block()
    {
        $this->isBlock = true;

        return $this;
    }

    public function close()
    {
        $this->isCloseable = true;

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
