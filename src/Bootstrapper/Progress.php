<?php
namespace Bootstrapper;

/**
 * Progress for creating Twitter Bootstrap style progress bar.
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
class Progress
{
    /**
     * Progress bar types
     * @var constant
     */
    const NORMAL  = '';
    const DANGER  = 'danger';
    const INFO    = 'info';
    const SUCCESS = 'success';
    const WARNING = 'warning';

    /**
     * Adds a bar to the current progress bar
     *
     * @param integer $amounts    A progress amount
     * @param string  $type       Type of progress bar
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    protected static function show($amounts = 0, $type = Progress::NORMAL, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'progress');

        // Create the progress bar(s)
        $progress = '<div'.Helpers::getContainer('html')->attributes($attributes).'>';
        if(!is_array($amounts)) {
            $amounts = array((int) $amounts => null);
        }
        foreach($amounts as $amount => $style) {
            if (!$style) {
                $style = $type;
            }
            $progress .= static::bar($amount, $style);
        }
        $progress .= '</div>';

        return $progress;
    }

    /**
     * Adds a bar to the current progress bar
     *
     * @param integer $amount A progress amount
     * @param string  $style  A class to use to style the bar
     *
     * @return string
     */
    protected static function bar($amount = 0, $style = null)
    {
        // Prepend bar style with 'bar-'
        $style = $style ? ' progress-bar-' . $style : null;
        return '<div class="progress-bar' .$style. '" style="width: ' .$amount. '%;"></div>';
    }

    /**
     * Create a new Normal Progress Bar.
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function normal($amount = 0, $attributes = array())
    {
        return static::show($amount, Progress::NORMAL, $attributes);
    }

    /**
     * Create a new Success Progress Bar.
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function success($amount = 0, $attributes = array())
    {
        return static::show($amount, Progress::SUCCESS, $attributes);
    }

    /**
     * Create a new Info Progress Bar.
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function info($amount = 0, $attributes = array())
    {
        return static::show($amount, Progress::INFO, $attributes);
    }

    /**
     * Create a new Warning Progress Bar.
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function warning($amount = 0, $attributes = array())
    {
        return static::show($amount, Progress::WARNING, $attributes);
    }

    /**
     * Create a new Danger Progress Bar.
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function danger($amount = 0, $attributes = array())
    {
        return static::show($amount, Progress::DANGER, $attributes);
    }

    /**
     * Automatically computes the progress bar's class according to the amount
     * Thus 0 giving it a danger class and 100 giving it a success class
     *
     * @param integer $amount     Amount filled
     * @param array   $attributes array of attributes for progress bar
     *
     * @return string
     */
    public static function automatic($amount = 0, $attributes = array())
    {
        $progress = array(PROGRESS::DANGER, Progress::WARNING, Progress::INFO, Progress::SUCCESS);
        $progress = array_get($progress, floor($amount / 25), Progress::SUCCESS);

        return static::show($amount, $progress, $attributes);
    }

    /**
     * Checks call to see if we can create a progress bar from a magic call (for you wizards).
     * normal_striped_active, info_striped, etc...
     *
     * @param string $method     Method name
     * @param array  $parameters Method parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $method_array = explode('_', strtolower($method));

        $types = array('normal', 'success', 'info', 'warning', 'danger', 'automatic');
        $type_found = array_intersect($method_array, $types);

        if (count($type_found) > 0) {
            $function = $type_found[key($type_found)];

            // Set default $attributes and check for a set value
            $attributes = array();
            if (isset($parameters[1])) {
                if (is_array($parameters[1])) {
                    $attributes = $parameters[1];
                } else {
                    throw new \InvalidArgumentException("Tabbable attributes parameter should be an array of attributes");
                }
            }

            if (in_array('striped', $method_array)) {
                $attributes = Helpers::add_class($attributes, 'progress-striped');
            }

            if (in_array('active', $method_array)) {
                $attributes = Helpers::add_class($attributes, 'active');
            }

            return static::$function($parameters[0], $attributes);
        }
    }
}
