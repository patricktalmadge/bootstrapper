<?php
namespace Bootstrapper;

use \HTML;

/**
 * Label for creating Twitter Bootstrap style Labels.
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
class Label
{
    /**
     * Label colors
     * @var constant
     */
    const NORMAL    = '';
    const IMPORTANT = 'label-important';
    const INFO      = 'label-info';
    const INVERSE   = 'label-inverse';
    const SUCCESS   = 'label-success';
    const WARNING   = 'label-warning';

    /**
     * Create a new Label
     *
     * @param string $type       Label type
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    protected static function show($type = Label::NORMAL, $message, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'label '.$type);

        return '<span'.HTML::attributes($attributes).'>'.$message.'</span>';
    }

    /**
     * Create a new Normal Label
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function normal($message, $attributes = array())
    {
        return static::show(Label::NORMAL, $message, $attributes);
    }

    /**
     * Create a new Success Label
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function success($message, $attributes = array())
    {
        return static::show(Label::SUCCESS, $message, $attributes);
    }

    /**
     * Create a new Warning Label
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function warning($message, $attributes = array())
    {
        return static::show(Label::WARNING, $message, $attributes);
    }

    /**
     * Create a new Important Label
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function important($message, $attributes = array())
    {
        return static::show(Label::IMPORTANT, $message, $attributes);
    }

    /**
     * Create a new Info Label instance
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function info($message, $attributes = array())
    {
        return static::show(Label::INFO, $message, $attributes);
    }

    /**
     * Create a new Inverse Label
     *
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function inverse($message, $attributes = array())
    {
        return static::show(Label::INVERSE, $message, $attributes);
    }

    /**
     * Create a new custom Label
     * This assumes you have created the appropriate css class for the label type.
     *
     * @param string $type       Label type
     * @param string $message    Label text
     * @param array  $attributes Attributes to apply the label itself
     *
     * @return string Label HTML
     */
    public static function custom($type, $message, $attributes = array())
    {
        $type = 'label-'.(string) $type;

        return static::show($type, $message, $attributes);
    }
}
