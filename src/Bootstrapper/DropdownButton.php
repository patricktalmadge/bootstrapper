<?php

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
     * @var string
     */
    protected $type = 'btn-default';
    /**
     * @var
     */
    protected $size;
    /**
     * @var bool
     */
    protected $split = false;
    /**
     * @var bool
     */
    protected $dropup = false;

    /**
     * @param $label
     * @return $this
     */
    public function labelled($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param $contents
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return $this
     */
    public function split()
    {
        $this->split = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function dropup()
    {
        $this->dropup = true;

        return $this;
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function normal($label = '')
    {
        $this->setType(self::NORMAL);

        return $this->labelled($label);
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function primary($label = '')
    {
        $this->setType(DropdownButton::PRIMARY);

        return $this->labelled($label);
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function danger($label = '')
    {
        $this->setType(DropdownButton::DANGER);

        return $this->labelled($label);
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function warning($label = '')
    {
        $this->setType(DropdownButton::WARNING);

        return $this->labelled($label);
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function success($label = '')
    {
        $this->setType(DropdownButton::SUCCESS);

        return $this->labelled($label);
    }

    /**
     * @param string $label
     * @return DropdownButton
     */
    public function info($label = '')
    {
        $this->setType(DropdownButton::INFO);

        return $this->labelled($label);
    }

    /**
     * @return $this
     */
    public function large()
    {
        $this->setSize(DropdownButton::LARGE);

        return $this;
    }


    /**
     * @return $this
     */
    public function small()
    {
        $this->setSize(DropdownButton::SMALL);

        return $this;
    }

    /**
     * @return $this
     */
    public function extraSmall()
    {
        $this->setSize(DropdownButton::EXTRA_SMALL);

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
