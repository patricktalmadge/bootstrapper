<?php namespace Bootstrapper;

use HtmlObject\Element;

/**
 * Alert for creating Twitter Bootstrap style alerts.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Alert extends Element
{
    /**
     * Alert styles
     *
     * @var constant
     */
    const DANGER  = 'alert-danger';
    const ERROR   = 'alert-error';
    const INFO    = 'alert-info';
    const SUCCESS = 'alert-success';
    const WARNING = 'alert-warning';

    /**
     * The type of the alert
     *
     * @var enum
     */
    private $type = Alert::SUCCESS;

    /**
     * Whether the current alert is closeable
     *
     * @var boolean
     */
    private $isCloseable = true;

    /**
     * Whether the current alert is block or not.
     *
     * @var boolean
     */
    private $isBlock = false;

    //////////////////////////////////////////////////////////////////
    ////////////////////////// CORE METHODS //////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Writes the current Alert
     *
     * @return string A Bootstrap Alert
     */
    public function render()
    {
        $this->addClass('alert');

        // Block alert
        if ($this->isBlock) $this->addClass('alert-block');

        // Add close icon if necessary
        if ($this->isCloseable) {
            $close = HTML::to('#', '&times;', array('class' => 'close', 'data-dismiss' => 'alert'));
            $this->nest($close);
        }

        return '<'.$this->element.HTML::attributes($this->attributes).'>'.$this->getContent().$this->close();
    }

    /**
     * Check to see if we're calling an informative alert
     *
     * @param string $method     The function called
     * @param array  $parameters Its parameters
     *
     * @return Alert
     */
    public static function __callStatic($method, $parameters)
    {
        // Extract real method and type of alert
        $method = explode('_', $method);

        // Search for "open_type" method
        $open = array_search('open', $method);
        if ($closable = ($open !== false)) {
            unset($method[$open]);
        }

        // Search for "block_type" method
        $block = array_search('block', $method);
        if ($blockType = ($block !== false)) {
            unset($method[$block]);
        }

        $type       = 'alert-'.implode('-', $method);
        $message    = array_get($parameters, 0);
        $attributes = array_get($parameters, 1);
        $instance   = Alert::show($type, $message, $attributes);

        $instance->open(!$closable);
        $instance->block($blockType);

        return $instance;
    }

    //////////////////////////////////////////////////////////////////
    ///////////////////////// PUBLIC METHODS /////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Force the alert to be open
     *
     * @param bool $closeable If the alert should be closeable or not
     *
     * @return Alert
     */
    public function open($closeable = false)
    {
        $this->isCloseable = $closeable;

        return $this;
    }


    /**
     * Make the alert block
     *
     * @param bool $block If the alert should be block or not
     *
     * @return Alert
     */
    public function block($block = true)
    {
        $this->isBlock = $block;

        return $this;
    }

    //////////////////////////////////////////////////////////////////
    /////////////////////////// ALERT TYPES //////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Create a new Alert.
     *
     * @param string $type         Type of alert
     * @param string $message      Message in alert
     * @param bool   $enable_close Is Alert closable
     * @param array  $attributes   Parent div attributes
     *
     * @return string Alert HTML
     */
    protected static function show($type, $message, $attributes = array())
    {
        $instance = new static('div', $message, $attributes);

        // Save given parameters
        $instance->addClass($type);

        return $instance;
    }

    /**
     * Create a new Success Alert.
     *
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function success($message, $attributes = array())
    {
        return static::show(Alert::SUCCESS, $message, $attributes);
    }

    /**
     * Create a new Info Alert.
     *
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function info($message, $attributes = array())
    {
        return static::show(Alert::INFO, $message, $attributes);
    }

    /**
     * Create a new Warning Alert.
     *
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function warning($message, $attributes = array())
    {
        return static::show(Alert::WARNING, $message, $attributes);
    }

    /**
     * Create a new Error Alert.
     *
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function error($message, $attributes = array())
    {
        return static::show(Alert::ERROR, $message, $attributes);
    }

    /**
     * Create a new Danger Alert.
     *
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function danger($message, $attributes = array())
    {
        return static::show(Alert::DANGER, $message, $attributes);
    }

    /**
     * Create a new custom Alert.
     * This assumes you have created the appropriate css class for the alert type.
     *
     * @param string $type       Type of alert
     * @param string $message    Message in alert
     * @param array  $attributes Parent div attributes
     *
     * @return string Alert HTML
     */
    public static function custom($type, $message, $attributes = array())
    {
        $type = 'alert-'.(string) $type;

        return static::show($type, $message, $attributes);
    }
}
