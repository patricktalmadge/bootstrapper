<?php
/**
 * Bootstrapper DropdownButton class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant Dropdown Buttons
 *
 * @package Bootstrapper
 */
class DropdownButton extends RenderedObject
{
    /**
     * Divider constant
     */
    const DIVIDER = "<li class='divider'></li>";

    /**
     * Constant for primary buttons
     */
    const PRIMARY = 'btn-primary';

    /**
     * Constant for danger buttons
     */
    const DANGER = 'btn-danger';

    /**
     * Constant for warning buttons
     */
    const WARNING = 'btn-warning';

    /**
     * Constant for success buttons
     */
    const SUCCESS = 'btn-success';

    /**
     * Constant for default buttons
     */
    const NORMAL = 'btn-default';

    /**
     * Constant for info buttons
     */
    const INFO = 'btn-info';

    /**
     * Constant for large buttons
     */
    const LARGE = 'btn-lg';

    /**
     * Constant for small buttons
     */
    const SMALL = 'btn-sm';

    /**
     * Constant for extra small buttons
     */
    const EXTRA_SMALL = 'btn-xs';

    /**
     * @var string The label for this button
     */
    protected $label;

    /**
     * @var array The contents of the dropdown button
     */
    protected $contents = [];

    /**
     * @var string The type of the button
     */
    protected $type = 'btn-default';

    /**
     * @var string The size of the button
     */
    protected $size;

    /**
     * @var bool Whether the drop icon should be a seperate button
     */
    protected $split = false;

    /**
     * @var bool Whether the button should drop up
     */
    protected $dropup = false;

    /**
     * Set the label of the button
     *
     * @param $label
     * @return $this
     */
    public function labelled($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the contents of the button
     *
     * @param array $contents The contents of the dropdown button
     * @return $this
     */
    public function withContents(array $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets the type of the button
     *
     * @param string $type The type of the button
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the size of the button
     *
     * @param string $size The size of the button
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Splits the button
     *
     * @return $this
     */
    public function split()
    {
        $this->split = true;

        return $this;
    }

    /**
     * Sets the button to drop up
     *
     * @return $this
     */
    public function dropup()
    {
        $this->dropup = true;

        return $this;
    }

    /**
     * Creates a normal dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function normal($label = '')
    {
        $this->setType(self::NORMAL);

        return $this->labelled($label);
    }

    /**
     * Creates a primary dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function primary($label = '')
    {
        $this->setType(self::PRIMARY);

        return $this->labelled($label);
    }

    /**
     * Creates a danger dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function danger($label = '')
    {
        $this->setType(self::DANGER);

        return $this->labelled($label);
    }

    /**
     * Creates a warning dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function warning($label = '')
    {
        $this->setType(self::WARNING);

        return $this->labelled($label);
    }

    /**
     * Creates a success dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function success($label = '')
    {
        $this->setType(self::SUCCESS);

        return $this->labelled($label);
    }

    /**
     * Creates a info dropdown button
     *
     * @param string $label The label
     * @return $this
     */
    public function info($label = '')
    {
        $this->setType(self::INFO);

        return $this->labelled($label);
    }

    /**
     * Sets the size to large
     *
     * @return $this
     */
    public function large()
    {
        $this->setSize(self::LARGE);

        return $this;
    }


    /**
     * Sets the size to small
     *
     * @return $this
     */
    public function small()
    {
        $this->setSize(self::SMALL);

        return $this;
    }

    /**
     * Sets the size to extra small
     *
     * @return $this
     */
    public function extraSmall()
    {
        $this->setSize(self::EXTRA_SMALL);

        return $this;
    }

    /**
     * Renders the dropdown button
     *
     * @return string
     */
    public function render()
    {
        if ($this->dropup) {
            $string = "<div class='btn-group dropup'>";
        } else {
            $string = "<div class='btn-group'>";
        }
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "btn {$this->type} dropdown-toggle",
                'data-toggle' => 'dropdown',
                'type' => 'button'
            ]
        );

        if ($this->size) {
            $attributes->addClass($this->size);
        }

        if ($this->split) {
            $splitAttributes = new Attributes(
                ['class' => $attributes['class'], 'type' => 'button']
            );
            $splitAttributes['class'] = str_replace(
                ' dropdown-toggle',
                '',
                $splitAttributes['class']
            );
            $string .= "<button {$splitAttributes}>{$this->label}</button>";
            $string .= "<button {$attributes}><span class='caret'></span></button>";
        } else {
            $string .= "<button {$attributes}>{$this->label} <span class='caret'></span></button>";
        }

        $string .= "<ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>";
        $string .= $this->renderItems();
        $string .= "</ul>";
        $string .= "</div>";

        return $string;
    }

    /**
     * Render the inner items
     *
     * @return string
     */
    protected function renderItems()
    {
        $string = '';
        foreach ($this->contents as $item) {
            if (is_array($item)) {
                $string .= "<li><a href='{$item['url']}'>{$item['label']}</a></li>";
            } else {
                $string .= $item;
            }
        }

        return $string;
    }
}
