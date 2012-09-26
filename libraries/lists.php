<?php
namespace Bootstrapper;

use \HTML;

/**
 * Class for creating lists and definition lists
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
class Lists
{

    /**
     * Creates a definition list
     *
     * @param array $list       An array [term => description]
     * @param array $attributes An array of attributes
     *
     * @return string           A formatted <dl> list
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
     * @return string           A formatted <dl> list
     */
    public static function horizontal_dl($list, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'dl-horizontal');

        return static::dl($list, $attributes);
    }
}