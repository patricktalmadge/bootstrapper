<?php
namespace Bootstrapper;

use \HTML;

/**
 * Typeahead for creating Twitter Bootstrap style Typeahead.
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
class Typeahead
{
    /**
     * Creates a new Typeahead instance.
     *
     * @param array $source     Array of items for list
     * @param int   $items      Number of items to display
     * @param array $attributes An array of attributes to use
     *
     * @return Typeahead
     */
    public static function create($source, $items = 8, $attributes = array())
    {
        $attributes['type']         = 'text';
        $attributes['data-items']   = $items;
        $attributes['data-provide'] = 'typeahead';
        $attributes['data-source']  = json_encode($source);

        return '<input'.HTML::attributes($attributes).'>';
    }
}
