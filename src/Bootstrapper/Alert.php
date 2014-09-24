<?php

namespace Bootstrapper;

class Alert extends RenderedObject
{    
    private $types = [
        'info'      => 'alert-info',
        'success'   => 'alert-success',
        'warning'   => 'alert-warning',
        'danger'    => 'alert-danger'
    ];

    private $type;
    private $contents;
    private $attributes = [];
    private $closer;

    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => "alert {$this->type}"]);

        if ($this->closer) {
            $attributes['class'] = trim($attributes['class']) . ' alert-dismissable';
            $this->contents = "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>{$this->closer}</button>{$this->contents}";
        }

        return "<div {$attributes}>{$this->contents}</div>";
    }
    
    public function message($contents = '')
    {
        return $this->withContents($contents);
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }
    
    public function type($type = 'info')
    {
        $this->type = $this->types[$type] ? : $type;
    
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
    
    public function __call($type, $parameters)
    {
        $message = isset($parameters[0]) ? $parameters[0] : '';
        $this->message($message)->type($type);

        return $this;
    }
    
}
