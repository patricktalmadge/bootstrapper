<?php

namespace Bootstrapper;

use Bootstrapper\Exceptions\ControlGroupException;

/**
 * Creates Bootstrap 3 compliant control groups (for forms)
 * @package Bootstrapper
 */
class ControlGroup extends RenderedObject
{

    /**
     * @var array The attributes for control group
     */
    protected $attributes = [];

    /**
     * @var array The contents of the control groups
     */
    protected $contents = [];

    /**
     * @var string The size of the control group
     */
    protected $controlSize;

    /**
     * @var string The label of control group
     */
    protected $label;

    /**
     * @var string The size of the label
     */
    protected $labelSize;

    /**
     * @var string The help text for the input
     */
    protected $help;

    /**
     * @var Form Laravel's form builder
     */
    protected $formBuilder;

    /**
     * @param Form $formBuilder An instance of the Bootstrapper formbuiler
     */
    public function __construct(Form $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * Renders the control group
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => 'form-group']
        );
        $string = "<div {$attributes}>";

        if ($this->label) {
            $string .= $this->renderLabel();
        }

        if ($this->controlSize) {
            $string .= $this->createControlDiv();
        }

        if (is_array($this->contents)) {
            $string .= $this->renderArrayContents();
        } else {
            $string .= $this->contents;
        }

        $string .= $this->help;

        if ($this->controlSize) {
            $string .= "</div>";
        }

        $string .= "</div>";

        return $string;
    }

    /**
     * Set the attributes of the control group
     *
     * @param $attributes array The attributes array
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Adds the contents to the control group
     *
     * @param $contents string The contents of the control group
     * @param $controlSize null|int The size of the form control
     * @return $this
     * @throws ControlGroupException If $controlSize is set and not between 1
     * and 12
     */
    public function withContents($contents, $controlSize = null)
    {
        if (isset($controlSize) && $this->sizeIsInvalid($controlSize)) {
            throw new ControlGroupException(
                'That content size is incorrect - it must be between 1 and 12'
            );
        }

        $this->contents = $contents;
        $this->controlSize = $controlSize;

        return $this;
    }

    /**
     * Sets the label of the control group
     *
     * @param $label string The label
     * @param $labelSize null|int The size of the label
     * @return $this
     * @throws ControlGroupException If $labelSize is set and not between 1
     * and 12
     */
    public function withLabel($label, $labelSize = null)
    {
        if (isset($labelSize) && $this->sizeIsInvalid($labelSize)) {
            throw new ControlGroupException(
                'That label size is incorrect - it must be between 1 and 12'
            );
        }

        $this->label = $label;
        $this->labelSize = $labelSize;

        return $this;
    }

    /**
     * Adds a help block
     *
     * @param $help string The help information
     * @return $this
     */
    public function withHelp($help)
    {
        $this->help = $help;

        return $this;
    }

    /**
     * Generates a full control group with a label, control and help block
     *
     * @param $label string The label
     * @param $control string The form control
     * @param $help string The help text
     * @param $labelSize int The size of the label
     * @param $controlSize int The size of the form control
     * @return $this
     * @throws ControlGroupException if the sizes are invalid
     */
    public function generate(
        $label,
        $control,
        $help = null,
        $labelSize = null,
        $controlSize = null
    ) {
        if ($this->sizesAreInvalid($labelSize, $controlSize)) {
            throw new ControlGroupException(
                'The label size + control size must be between 1 and 12'
            );
        }

        return $this->withLabel($label, $labelSize)
            ->withContents($control, $controlSize)
            ->withHelp($help);
    }

    /**
     * Renders the contents if given as an array
     *
     * @return string
     */
    protected function renderArrayContents()
    {
        $string = '';
        foreach ($this->contents as $item) {
            if (isset($item['label'])) {
                $string .= call_user_func_array(
                        [$this->formBuilder, 'label'],
                        $item['label']
                    ) . ' ';
            }

            $input_args = $item['input'];
            $type = $input_args['type'];
            unset($input_args['type']);

            $string .= call_user_func_array(
                [$this->formBuilder, $type],
                $input_args
            );

            $string .= '<br />';
        }

        return $string;
    }

    /**
     * Renders the label
     *
     * @return string
     */
    public function renderLabel()
    {
        $string = '';

        if ($this->labelSize) {
            $this->controlSize = $this->controlSize ?: 12 - $this->labelSize;

            $this->label = preg_replace(
                "/class=('|\")(.*)('|\")/i",
                sprintf('class=${1}${2} col-sm-%s${3}', $this->labelSize),
                $this->label
            );
        }

        $string .= $this->label;
        return $string;
    }

    /**
     * Creates the div to surround the form control
     *
     * @return string
     */
    public function createControlDiv()
    {
        return sprintf("<div class='col-sm-%s'>", $this->controlSize);
    }

    /**
     * Checks if both the label size and control size are invalid
     *
     * @param $labelSize int The size of the label
     * @param $controlSize int The size of the control group
     * @return bool
     */
    protected function sizesAreInvalid($labelSize = null, $controlSize = null)
    {
        // If both are null then we have a valid size
        if (!isset($labelSize) && !isset($controlSize)) {
            return false;
        }

        // So at least one of these is null
        if (isset($labelSize)) {
            if ($this->sizeIsInvalid($labelSize)) {
                return true;
            }
        } else {
            $labelSize = 0;
        }

        if (isset($controlSize)) {
            if ($this->sizeIsInvalid($controlSize)) {
                return true;
            }
        } else {
            $controlSize = 0;
        }

        return $this->sizeIsInvalid($labelSize + $controlSize);
    }

    /**
     * Checks if the size is invalid
     *
     * @param $size int The size
     * @return bool True if the size is below 1 or greater than 11,
     * false otherwise
     */
    protected function sizeIsInvalid($size)
    {
        return $size < 1 || $size > 11;
    }
}