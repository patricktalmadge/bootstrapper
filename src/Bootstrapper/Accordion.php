<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\AccordionException;

/**
 * Accordion Class
 * Creates Bootstrap 3 compliant accordions
 * @package Bootstrapper
 * @author Patrick Rose
 */
class Accordion extends RenderedObject
{

    private $name;
    private $contents = [];
    private $attributes = [];
    private $opened = -1;

    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    public function render()
    {
        if (!$this->name) {
            throw new AccordionException("You have not named this accordion");
        }
        $attributes = new Attributes($this->attributes, ['class' => 'panel-group', 'id' => $this->name]);

        $string = "<div {$attributes}>";
        $count = 0;
        foreach ($this->contents as $item) {
            $itemAttributes = array_key_exists('attributes', $item) ? $item['attributes'] : [];

            $itemAttributes = new Attributes($itemAttributes, ['class' => 'panel panel-default']);

            $string .= "<div {$itemAttributes}>";
            $string .= "<div class='panel-heading'>";
            $string .= "<h4 class='panel-title'>";
            $string .= "<a data-toggle='collapse' data-parent='#{$this->name}' href='#{$this->name}-{$count}'>{$item['title']}</a>";
            $string .= "</h4>";
            $string .= "</div>";

            $bodyAttributes = new Attributes(['id' => "{$this->name}-{$count}", 'class' => 'panel-collapse collapse']);

            if ($this->opened == $count) {
                $bodyAttributes['class'] .= ' in';
            }

            $string .= "<div {$bodyAttributes}>";
            $string .= "<div class='panel-body'>{$item['contents']}</div>";
            $string .= "</div>";
            $string .= "</div>";
            $count++;
        }
        $string .= "</div>";

        return $string;
    }

    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function withAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }


    public function open($integer)
    {
        $this->opened = $integer;

        return $this;
    }
}
