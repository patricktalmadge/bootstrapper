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
    private $attributes = [];
    private $closer;

    private function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "alert {$this->type}"]);

        if ($this->closer) {
            $attributes['class'] = trim($attributes['class']) . ' alert-dismissable';
            $this->contents = "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>{$this->closer}</button>{$this->contents}";
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

    public function close($closer = '&times;')
    {
        $this->closer = $closer;

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
