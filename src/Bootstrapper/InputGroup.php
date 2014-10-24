<?php
/**
 * Bootstrapper InputGroup class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant input groups (for forms)
 *
 * @package Bootstrapper
 */
class InputGroup extends RenderedObject
{

    /**
     * Constant for large input groups
     */
    const LARGE = 'input-group-lg';

    /**
     * Constant for small input groups
     */
    const SMALL = 'input-group-sm';

    /**
     * @var string The size of the input group
     */
    protected $size = '';

    /**
     * @var array What we should append
     */
    protected $append;

    /**
     * @var array What we should prepend
     */
    protected $prepend;

    /**
     * @var string The contents of the input group
     */
    protected $contents;

    /**
     * Renders the input group
     *
     * @return string
     */
    public function render()
    {
        $attributes = ['class' => "input-group {$this->size}"];
        $attributes = new Attributes($this->attributes, $attributes);

        $string = "<div {$attributes}>";
        if (is_array($this->prepend)) {
            $string .= $this->renderAddon($this->prepend);
        }

        $string .= $this->contents;

        if (is_array($this->append)) {
            $string .= $this->renderAddon($this->append);
        }

        $string .= "</div>";

        return $string;
    }

    /**
     * Renders an addon
     *
     * @param array $addon The addon to render
     * @return string
     */
    protected function renderAddon(array $addon)
    {
        $string = "";
        if ($addon['isButton']) {
            $string .= "<span class='input-group-btn'>";
        } else {
            $string .= "<span class='input-group-addon'>";
        }
        $string .= $addon['value'];
        $string .= "</span>";

        return $string;
    }


    /**
     * Sets the contents of the input group
     *
     * @param string $contents The new contents
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets the size of the input group
     *
     * @param string $size The new size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Prepends something to the input
     *
     * @param string $prepend  The value to prepend
     * @param bool   $isButton Whether the value is a button
     * @return $this
     */
    public function prepend($prepend, $isButton = false)
    {
        $this->prepend = ['value' => $prepend, 'isButton' => $isButton];

        return $this;
    }

    /**
     * Prepend a button
     *
     * @param string $button The button to prepend
     * @return $this
     */
    public function prependButton($button)
    {
        return $this->prepend($button, true);
    }

    /**
     * Appends something to the input
     *
     * @param string $append   The value to append
     * @param bool   $isButton Whether the value is a button
     * @return $this
     */
    public function append($append, $isButton = false)
    {
        $this->append = ['value' => $append, 'isButton' => $isButton];

        return $this;
    }

    /**
     * Append a button
     *
     * @param string $button The button to append
     * @return $this
     */
    public function appendButton($button)
    {
        return $this->append($button, true);
    }

    /**
     * Makes the input group large
     *
     * @return $this
     */
    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }

    /**
     * Makes the input group small
     *
     * @return $this
     */
    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }
}
