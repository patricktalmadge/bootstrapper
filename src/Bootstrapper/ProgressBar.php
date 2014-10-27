<?php
/**
 * Bootstrapper ProgressBar class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant progress bars
 *
 * @package Bootstrapper
 */
class ProgressBar extends RenderedObject
{

    /**
     * Constant for success progress bars
     */
    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';

    /**
     * Constant for info progress bars
     */
    const PROGRESS_BAR_INFO = 'progress-bar-info';

    /**
     * Constant for warning success progress bars
     */
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';

    /**
     * Constant for danger progress bars
     */
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';

    /**
     * Constant for normal progress bars
     */
    const PROGRESS_BAR_NORMAL = 'progress-bar-default';

    /**
     * @var int The value of the progress bar
     */
    protected $value = 0;

    /**
     * @var bool Whether text should be visible
     */
    protected $visible = false;

    /**
     * @var string The type of the progress bar
     */
    protected $type = '';

    /**
     * @var bool Whether the progress bar should be striped
     */
    protected $striped = false;

    /**
     * @var bool Whether the progress bar should be animated
     */
    protected $animated = false;

    /**
     * @var string What the visible string should be
     */
    protected $visibleString;

    /**
     * Renders the progress bar
     *
     * @return string
     */
    public function render()
    {
        $string = "<div class='progress'>";

        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "progress-bar {$this->type}",
                'role' => 'progressbar',
                'aria-valuenow' => "{$this->value}",
                'aria-valuemin' => '0',
                'aria-valuemax' => '100',
                'style' => $this->value ? "width: {$this->value}%" : ''
            ]
        );

        if ($this->striped) {
            $attributes->addClass('progress-bar-striped');
        }

        if ($this->animated) {
            $attributes->addClass('active');
        }

        $string .= "<div {$attributes}>";

        $string .= $this->visible ?
            sprintf($this->visibleString, $this->value) :
            "<span class='sr-only'>{$this->value}% complete</span>";

        $string .= "</div>";

        $string .= "</div>";

        return $string;
    }

    /**
     * Sets the type of the progress bar
     *
     * @param string $type The type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the value of the progress bar
     *
     * @param int $value The value of the progress bar The value of the
     *                   progress bar
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Whether the amount should be visible
     *
     * @param string $string The string to show to the user. We internally
     *                       will use sprintf to show this, so you must
     *                       include a %s somewhere so we can add this in
     * @return $this
     */
    public function visible($string = '%s%%')
    {
        $this->visible = true;
        $this->visibleString = $string;

        return $this;
    }

    /**
     * Creates a success progress bar
     *
     * @param int $value The value of the progress bar
     * @return $this
     */
    public function success($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_SUCCESS);

        return $this->value($value);
    }

    /**
     * Creates an info progress bar
     *
     * @param int $value The value of the progress bar
     * @return $this
     */
    public function info($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_INFO);

        return $this->value($value);
    }

    /**
     * Creates a warning progress bar
     *
     * @param int $value The value of the progress bar
     * @return $this
     */
    public function warning($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_WARNING);

        return $this->value($value);
    }

    /**
     * Creates a danger progress bar
     *
     * @param int $value The value of the progress bar
     * @return $this
     */
    public function danger($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_DANGER);

        return $this->value($value);
    }

    /**
     * Creates a normal progress bar
     *
     * @param int $value The value of the progress bar
     * @return $this
     */
    public function normal($value = 0)
    {
        $this->setType(self::PROGRESS_BAR_NORMAL);

        return $this->value($value);
    }

    /**
     * Sets the progress bar to be striped
     *
     * @return $this
     */
    public function striped()
    {
        $this->striped = true;

        return $this;
    }

    /**
     * Sets the progress bar to be animated
     *
     * @return $this
     */
    public function animated()
    {
        $this->animated = true;

        return $this->striped();
    }

    /**
     * Stacks several progress bars together
     *
     * @param array $items The progress bars. Should be an array of arrays,
     *                     which are a list of methods and parameters.
     * @return string
     */
    public function stack(array $items)
    {
        $string = '<div class=\'progress\'>';
        foreach ($items as $progressBar) {
            $string .= $this->generateFromArray($progressBar);
        }
        $string .= '</div>';

        return $string;
    }

    /**
     * Generates a progress bar from an array
     *
     * @param array $progressBar An array of methods with variables if required,
     *                           eg 'value=2', 'animated'
     * @return mixed
     */
    protected function generateFromArray(array $progressBar)
    {
        $bar = new static;

        foreach ($progressBar as $attribute) {
            $exploded = explode('=', $attribute);
            $method = $exploded[0];
            $vars = isset($exploded[1]) ? $exploded[1] : null;
            if (isset($vars)) {
                $bar->$method($vars);
            } else {
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
