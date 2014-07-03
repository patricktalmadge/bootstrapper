<?php

namespace Bootstrapper;

class ProgressBar extends RenderedObject
{

    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';
    const PROGRESS_BAR_INFO = 'progress-bar-info';
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';
    private $value = 0;
    private $visible = false;
    private $type = '';
    private $striped = false;
    private $animated = false;

    public function render()
    {
        $string = "<div class='progress'>";
        $attributes = new Attributes(['class' => $this->type], ['class'=>'progress-bar', 'role'=>'progressbar', 'aria-valuenow'=>"{$this->value}", 'aria-valuemin'=>'0', 'aria-valuemax'=>'100', 'style'=>$this->value ? "width: {$this->value}%" : '']);
        if($this->striped) {
            $attributes['class'] .= ' progress-bar-striped';
        }
        if($this->animated) {
            $attributes['class'] .= ' active';
        }
        $string .= "<div {$attributes}>";
        $string .= $this->visible ? "{$this->value}%" : "<span class='sr-only'>{$this->value}% complete</span>";
        $string .= "</div>";
        $string .= "</div>";

        return $string;
    }

    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    public function visible()
    {
        $this->visible = true;

        return $this;
    }

    public function success()
    {
        $this->setType(self::PROGRESS_BAR_SUCCESS);

        return $this;
    }

    public  function setType($type)
    {
        $this->type = $type;
    }

    public function info()
    {
        $this->setType(self::PROGRESS_BAR_INFO);

        return $this;
    }

    public function warning()
    {
        $this->setType(self::PROGRESS_BAR_WARNING);

        return $this;
    }

    public function danger()
    {
        $this->setType(self::PROGRESS_BAR_DANGER);

        return $this;
    }

    public function striped()
    {
        $this->striped = true;

        return $this;
    }

    public function animated()
    {
        $this->animated = true;

        return $this->striped();
    }

    public function stack($items)
    {
        $string = '<div class=\'progress\'>';
        foreach($items as $progressBar) {
            $string .= $this->generateFromArray($progressBar);
        }
        $string .= '</div>';

        return $string;
    }

    private function generateFromArray($attributes)
    {
        $bar = new static;
        foreach($attributes as $attribute) {
            $exploded = explode('=', $attribute);
            $method = $exploded[0];
            $vars = isset($exploded[1]) ? $exploded[1] : null;
            $bar->$method($vars);
        }
        // Now to remove the outer divs
        $string = $bar->render();
        $string = str_replace('<div class=\'progress\'>', '', $string);
        $string = str_replace('</div></div>', '</div>', $string);

        return $string;
    }
}
