<?php
/**
 * Bootstrapper Accordion class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant accordions
 *
 * @package Bootstrapper
 * @author  Patrick Rose
 */
class Accordion extends RenderedObject
{

    /**
     * @var String name of the object (used when creating the links)
     */
    protected $name;

    /**
     * @var array The contents of the accordion
     */
    protected $contents = [];

    /**
     * @var int Which panel (if any) should be opened
     */
    protected $opened = -1;

    /**
     * Name the accordion
     *
     * @param $name The name of the accordion
     * @return $this
     */
    public function named($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add the contents for the accordion. Should be an array of arrays
     * <strong>Expected Keys</strong>:
     * <ul>
     * <li>title</li>
     * <li>contents</li>
     * <li>attributes (optional)</li>
     * </ul>
     *
     * @param array $contents
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets which panel should be opened. Numbering begins from 0.
     *
     * @param $integer int
     * @return $this
     */
    public function open($integer)
    {
        $this->opened = $integer;

        return $this;
    }

    /**
     * Renders the accordion
     *
     * @return string
     */
    public function render()
    {
        if (!$this->name) {
            $this->name = Helpers::generateId($this);
        }

        $attributes = new Attributes(
            $this->attributes,
            ['class' => 'panel-group', 'id' => $this->name]
        );

        $string = "<div {$attributes}>";
        $count = 0;
        foreach ($this->contents as $item) {
            $itemAttributes = array_key_exists(
                'attributes',
                $item
            ) ? $item['attributes'] : [];

            $itemAttributes = new Attributes(
                $itemAttributes,
                ['class' => 'panel panel-default']
            );

            $string .= "<div {$itemAttributes}>";
            $string .= "<div class='panel-heading'>";
            $string .= "<h4 class='panel-title'>";
            $string .= "<a data-toggle='collapse' data-parent='#{$this->name}' "
                     . "href='#{$this->name}-{$count}'>{$item['title']}</a>";
            $string .= "</h4>";
            $string .= "</div>";

            $bodyAttributes = new Attributes(
                [
                    'id' => "{$this->name}-{$count}",
                    'class' => 'panel-collapse collapse'
                ]
            );

            if ($this->opened == $count) {
                $bodyAttributes->addClass('in');
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
}
