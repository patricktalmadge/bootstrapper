<?php
namespace Bootstrapper;

use \HTML;

/**
 * Typography for creating Twitter Bootstrap typography elments.
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
class Typography
{

    /**
     * Typography types
     * @var constant
     */
    const LEAD    = 'lead';
    const MUTED   = 'muted';
    const WARNING = 'text-warning';
    const ERROR   = 'text-error';
    const INFO    = 'text-info';
    const SUCCESS = 'text-success';

    /**
     * Create a new Typography.
     *
     * @param string $type       Type of Typography
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    protected static function createEmphasis($type, $message, $tag = 'p', $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, $type);

        return '<'.$tag.HTML::attributes($attributes).'>'.$message.'</'.$tag.'>';
    }

    /* Create a new lead text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function lead($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::LEAD, $message, $tag, $attributes);
    }

    /**
     * Create a new muted text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function muted($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::MUTED, $message, $tag, $attributes);
    }

    /**
     * Create a new warning text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function warning($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::WARNING, $message, $tag, $attributes);
    }

    /**
     * Create a new error text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function error($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::ERROR, $message, $tag, $attributes);
    }

    /**
     * Create a new info text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function info($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::INFO, $message, $tag, $attributes);
    }

    /**
     * Create a new success text.
     *
     * @param string $message    Message in tag
     * @param array  $attributes Parent div attributes
     *
     * @return string Typography HTML
     */
    public static function success($message, $tag = 'p', $attributes = array())
    {
        return static::createEmphasis(Typography::SUCCESS, $message, $tag, $attributes);
    }

    /**
     * Creates a definition list
     *
     * @param array $list       An array [term => description]
     * @param array $attributes An array of attributes
     *
     * @return string A formatted <dl> list
     */
    public static function dl($list, $attributes = array())
    {
        $dl = null;

        // Check if the list contains anything
        if (count($list) == 0) {
            return false;
        }

        // Write each entry
        foreach ($list as $term => $description) {
            $dl .= '<dt>'.HTML::entities($term).'</dt>';
            $dl .= '<dd>'.HTML::entities($description).'</dd>';
        }

        return '<dl'.HTML::attributes($attributes).'>'.$dl.'</dl>';
    }

    /**
     * Creates an horizontal definition list
     *
     * @param array $list       An array [term => description]
     * @param array $attributes An array of attributes
     *
     * @return string A formatted <dl> list
     */
    public static function horizontal_dl($list, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'dl-horizontal');

        return static::dl($list, $attributes);
    }
}
