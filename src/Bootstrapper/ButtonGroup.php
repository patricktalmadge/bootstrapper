<?php

namespace Bootstrapper;

class ButtonGroup
{

    private $contents = [];
    private $buttonType = 'radio';

    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';

    public function render()
    {
        $string = "<div class='button-group' data-toggle='buttons'>";
        foreach ($this->contents as $item) {
            $item['type'] = isset($item['type']) ? $item['type'] : 'btn-default';
            $string .= "<label class='btn {$item['type']}'><input type='{$this->buttonType}'>{$item['contents']}</label>";
        }
        $string .= "</div>";

        return $string;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function asType($type)
    {
        $this->buttonType = $type;

        return $this;
    }
}
