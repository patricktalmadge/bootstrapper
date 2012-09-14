<?php
namespace Bootstrapper;

use \HTML;

/**
 * Progress for creating Twitter Bootstrap style progress bar.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Progress
{
    /**
     * Progress bar types
     * @var constant
     */
    const NORMAL  = '';
    const DANGER  = 'progress-danger';
    const INFO    = 'progress-info';
    const SUCCESS = 'progress-success';
    const WARNING = 'progress-warning';

    protected static function show($amounts, $type = Progress::NORMAL, $attributes = array())
    {
        if(is_array($amounts)) $type = Progress::NORMAL;
        $attributes = Helpers::add_class($attributes, 'progress '.$type);

        // Create the progress bar(s)
        $progress = '<div'.HTML::attributes($attributes).'>';
            if(!is_array($amounts)) $amounts = array((int) $amounts => null);
            foreach($amounts as $amount => $style)
                $progress .= static::bar($amount, $style);
        $progress .= '</div>';

        return $progress;
    }

    /**
     * Adds a bar to the current progress bar
     *
     * @param  integer $amount A progress amount
     * @param  string  $style  A class to use to style the bar
     * @return string  A Bootstrap bar
     */
    protected static function bar($amount, $style = null)
    {
        // Prepend bar style with 'bar-'
        $style = $style ? ' bar-'.$style : null;

        return '<div class="bar' .$style. '" style="width: ' .$amount. '%;"></div>';
    }

    /**
     * Create a new Normal Progress Bar.
     *
     * @param  string   $amount
     * @param  array  $attributes
     * @return Progress
     */
    public static function normal($amount, $attributes = array())
    {
        return static::show($amount, Progress::NORMAL, $attributes);
    }

    /**
     * Create a new Success Progress Bar.
     *
     * @param  string   $amount
     * @param  array  $attributes
     * @return Progress
     */
    public static function success($amount, $attributes = array())
    {
        return static::show($amount, Progress::SUCCESS, $attributes);
    }

    /**
     * Create a new Info Progress Bar.
     *
     * @param  string   $amount
     * @param  array    $attributes
     * @return Progress
     */
    public static function info($amount, $attributes = array())
    {
        return static::show($amount, Progress::INFO, $attributes);
    }

    /**
     * Create a new Warning Progress Bar.
     *
     * @param  string   $amount
     * @param  array    $attributes
     * @return Progress
     */
    public static function warning($amount, $attributes = array())
    {
        return static::show($amount, Progress::WARNING, $attributes);
    }

    /**
     * Create a new Danger Progress Bar.
     *
     * @param  string   $amount
     * @param  array    $attributes
     * @return Progress
     */
    public static function danger($amount, $attributes = array())
    {
        return static::show($amount, Progress::DANGER, $attributes);
    }

    /**
     * Checks call to see if we can create a progress bar from a magic call (for you wizards).
     * normal_striped_active, info_striped, etc...
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed
    */
    public static function __callStatic($method, $parameters)
    {
        $method_array = explode('_', strtolower($method));

        $types = array('normal', 'success', 'info', 'warning', 'danger');
        $type_found = array_intersect($method_array, $types);

        if (count($type_found) > 0) {
            $function = $type_found[key($type_found)];

            // Set default $attributes and check for a set value
            $attributes = array();
            if (isset($parameters[1])) {
                if (is_array($parameters[1])) {
                    $attributes = $parameters[1];
                } else {
                    throw new \Exception("Tabbable attributes parameter should be an array of attributes");
                }
            }

            if (in_array ('striped', $method_array)) {
                $attributes = Helpers::add_class($attributes, 'progress-striped');
            }

            if (in_array ('active', $method_array)) {
                $attributes = Helpers::add_class($attributes, 'active');
            }

            return static::$function($parameters[0], $attributes);
        }
    }
}
