<?php

namespace Bootstrapper;

class ProgressBar extends RenderedObject
{

    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';
    const PROGRESS_BAR_INFO = 'progress-bar-info';
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';
    const PROGRESS_BAR_NORMAL = 'progress-bar-default';

    private $value = 0;
    private $visible = false;
    private $type = '';
    private $striped = false;
    private $animated = false;
    private $visibleString;

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
        $string .= $this->visible ? sprintf($this->visibleString, $this->value) : "<span class='sr-only'>{$this->value}% complete</span>";
        $string .= "</div>";
        $string .= "</div>";

        return $string;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    public function visible($string = '%s%%')
    {
        $this->visible = true;
        $this->visibleString = $string;

        return $this;
    }

    public function success($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_SUCCESS);

        return $this->value($value);
    }

    public function info($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_INFO);

        return $this->value($value);
    }

    public function warning($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_WARNING);

        return $this->value($value);
    }

    public function danger($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_DANGER);

        return $this->value($value);
    }

    public function normal($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_NORMAL);

        return $this->value($value);
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
            if (isset($vars))
            {
                $bar->$method($vars);
            }
            else
            {
                $bar->$method();
            }
        }
        // Now to remove the outer divs
        $string = $bar->render();
        $string = str_replace('<div class=\'progress\'>', '', $string);
        $string = str_replace('</div></div>', '</div>', $string);

        return $string;
    }
}
