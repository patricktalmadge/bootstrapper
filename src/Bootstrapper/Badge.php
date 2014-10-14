<?php

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant Badges
 *
 * @package Bootstrapper
 */
class Badge extends RenderedObject
{

    /**
     * @var string The contents of the badge
     */
    protected $contents;

    /**
     * @var array The attributes of the badge
     */
    protected $attributes = [];

    /**
     * Renders the badge
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => 'badge']);

        $string = "<span {$attributes}>{$this->contents}</span>";

        return $string;
    }

    /**
     * Adds contents to the badge
     *
     * @param $contents
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }


    /**
     * Adds attributes to the badge
     *
     * @param $attributes array
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
