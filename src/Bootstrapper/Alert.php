<?php
/**
 * Bootstrapper Alert class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant alert boxes
 *
 * @package Bootstrapper
 * @author  Patrick Rose
 */
class Alert extends RenderedObject
{

    /**
     * Constant for info alerts
     */
    const INFO = 'alert-info';

    /**
     * Constant for success alerts
     */
    const SUCCESS = 'alert-success';

    /**
     * Constant for warning alerts
     */
    const WARNING = 'alert-warning';

    /**
     * Constant for danger alerts
     */
    const DANGER = 'alert-danger';

    /**
     * @var string The type of the alert
     */
    protected $type;

    /**
     * @var string The contents of the alert
     */
    protected $contents;

    /**
     * @var string What should we use to generate a close tag
     */
    protected $closer;

    /**
     * Sets the type of the alert. The alert prefix is not assumed.
     *
     * @param $type string
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Renders the alert
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => "alert {$this->type}"]
        );

        if ($this->closer) {
            $attributes->addClass('alert-dismissable');
            $this->contents = "<button type='button' class='close' " .
                "data-dismiss='alert' aria-hidden='true'>{$this->closer}" .
                "</button>{$this->contents}";
        }

        return "<div {$attributes}>{$this->contents}</div>";
    }

    /**
     * Creates an info alert box
     *
     * @param string $contents
     * @return $this
     */
    public function info($contents = '')
    {
        return $this->setType(self::INFO)->withContents($contents);
    }

    /**
     * Creates a success alert box
     *
     * @param string $contents
     * @return $this
     */
    public function success($contents = '')
    {
        return $this->setType(self::SUCCESS)->withContents($contents);
    }

    /**
     * Creates a warning alert box
     *
     * @param string $contents
     * @return $this
     */
    public function warning($contents = '')
    {
        return $this->setType(self::WARNING)->withContents($contents);
    }

    /**
     * Creates a danger alert box
     *
     * @param string $contents
     * @return $this
     */
    public function danger($contents = '')
    {
        return $this->setType(self::DANGER)->withContents($contents);
    }

    /**
     * Sets the contents of the alert box
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
     * Adds a close button with the given text
     *
     * @param string $closer
     * @return $this
     */
    public function close($closer = '&times;')
    {
        $this->closer = $closer;

        return $this;
    }
}
