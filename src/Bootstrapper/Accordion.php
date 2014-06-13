<?php

namespace Bootstrapper;

    /**
     * Accordion Class
     * Creates Bootstrap 3 compliant accordions
     * @package Bootstrapper
     * @author Patrick Rose
     */
/**
 * Class Accordion
 * @package Bootstrapper
 */
class Accordion
{

    /**
     * @var string Name of the accordion. Used as the id
     */
    public $name;

    /**
     * @var array Any attributes
     */
    public $attributes;

    /**
     * @var array The contents of the accordion
     */
    public $contents = [];

    private $open = 0;

    /**
     * @param string $name Name of the accordion. Used as the id
     * @param array $attributes Any attributes
     */
    public function __construct($name, $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    /**
     * @param $name string Name of the accordion. Used as the id
     * @param array $attributes Any attributes
     * @return \Bootstrapper\Accordion
     */
    public function create($name, $attributes = [])
    {
        return new Accordion($name, $attributes);
    }

    /**
     * @param array $contents The contents to add
     * @return $this
     */
    public function addContents(array $contents)
    {
        if (array_key_exists("header", $contents)) {
            array_push($this->contents, $contents);
        } else {
            foreach ($contents as $item) {
                $this->contents[] = $item;
            }
        }

        return $this;
    }

    public function render()
    {
        return $this->__toString();
    }

    public function __toString()
    {

        $name = $this->name;
        $attributes = new Attributes($this->attributes, ['class' => 'panel-group', 'id' => $this->name]);

        $string = "<div {$attributes}>";
        $count = 1;
        foreach ($this->contents as $item) {

            $heading = $item['header'];
            $body = $item['contents'];
            $attributes = array_key_exists('attributes', $item) ? $item['attributes'] : [];

            $attributes = new Attributes($attributes, ['class' => 'panel panel-default']);

            $string .= "<div {$attributes}>";
            $string .= "<div class='panel-heading'>";
            $string .= "<h4 class='panel-title'>";
            $string .= "<a class='accordion-toggle' data-toggle='collapse' data-parent='#{$name}' href='#{$name}-{$count}'>";
            $string .= $heading;
            $string .= "</a>";
            $string .= "</h4>";
            $string .= "</div>";

            $bodyAttributes = ['class'=>'panel-collapse collapse', 'id'=>"{$name}-{$count}"];
            if ($count == $this->open) {
                $bodyAttributes['class'] .= ' in';
            }

            $bodyAttributes = new Attributes($bodyAttributes);

            $string .= "<div {$bodyAttributes}>";
            $string .= "<div class='panel-body'>";
            $string .= $body;
            $string .= "</div>";
            $string .= "</div>";
            $string .= "</div>";
            $count += 1;
        }
        $string .= "</div>";

        return $string;
    }

    public function open($number)
    {
        $this->open = $number;

        return $this;
    }
}
