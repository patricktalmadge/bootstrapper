<?php
namespace Bootstrapper;

use \HTML;

/**
 * Small helper class for creating tables with Bootstrap
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Tables
{
    private static $numberColumns = 50;

    /**
     * Creates a table opening tag
     *
     * @param  array  $attributes An array of attributes
     * @return string             A table opening tag
     */
    public static function table($attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'table');

        return '<table'.HTML::attributes($attributes).'>';
    }

    /**
     * Closes current table
     *
     * @return string A </table> closing tag
     */
    public static function close()
    {
        return '</table>';
    }

    /**
     * Creates a table-wide row to display content
     *
     * @param  string $content    The content to display
     * @param  array  $attributes The rows's attributes
     * @return string             A single-column row spanning all table
     */
    public static function full_row($content, $attributes = array())
    {
        // Add a class for easy styling
        $attributes = Helpers::add_class($attributes, 'full-row');

        return
        '<tr' .HTML::attributes($attributes). '>
            <td colspan="' .static::$numberColumns. '">' .$content. '</td>
        </tr>';
    }

    /**
     * Display an array of data
     *
     * @param  mixed  $source        Can be an array of data or models
     * @param  array  $ignore        An array of columns to ignore
     * @param  mixed  $supplementary An array of supplementary columns to append
     * @return string                A table body
     */
    public static function display($source, $ignore = array(), $supplementary = array())
    {
        // Open Table body
        $html = '<tbody>';

        // If no data given, return false
        if(!$source) return false;

        // Iterate through the data
        foreach ($source as $row) {
            $html .= '<tr>';
            $data = is_object($row) ? $row->attributes : $row;

            // Read the data row with ignored keys
            foreach ($data as $column => $value) {
                if(in_array($column, $ignore)) continue;

                // Check for replacing columns
                $replace = array_get($supplementary, $column);
                if($replace) {
                    if(is_callable($replace)) $value = $replace($row);
                    $value = static::replace_keywords($value, $data);
                }

                $html .= '<td class="column-' .$column. '">'. $value. '</td>';
            }

            // Add supplementary columns
            foreach ($supplementary as $class => $column) {

                // Check for replacing columns
                if(isset($data[$class])) continue;

                // Calculate closures
                if(is_callable($column)) $column = $column($row);

                $column = static::replace_keywords($column, $data);
                $html .= '<td class="column-'.$class.'">' .$column. '</td>';
            }
            $html .= '</tr>';
        }

        return $html.'</tbody>';
    }

    /**
     * Creates a table <thead> tag
     *
     * @param  array  $headers An array of thead rows
     * @return string          A <thead> tag prefilled with rows
     */
    public static function headers($headers = array())
    {
        $thead = '<thead>'.PHP_EOL;

        // Store the number of columns in this table
        static::$numberColumns = sizeof($headers);

        // Add each header with its attributes
        foreach ($headers as $header => $attributes) {

            // Allows to not specify an attributes array for leaner syntax
            if (is_string($attributes) and is_numeric($header)) {
                $header = $attributes;
                $attributes = array();
            }

            $thead .= '<th'.HTML::attributes($attributes).'>' .$header. '</th>'.PHP_EOL;
        }

        $thead .= '</thead>'.PHP_EOL;

        return $thead;
    }

    /**
     * Replace keywords with data in a string
     *
     * @param  string $string A string with Laravel patterns (:key)
     * @param  array  $data   An array of data to fetch from
     * @return string         The modified string
     */
    private static function replace_keywords($string, $data)
    {
        // Gather used patterns
        preg_match_all('/\(:(.+)\)/', $string, $matches);

        // Replace patterns with data
        foreach ($matches[0] as $key => $replace) {
            $with   = array_get($matches, '1.'.$key);
            $with   = array_get($data, $with);
            $string = str_replace($replace, $with, $string);
        }

        return $string;
    }

    /**
     * Checks call to see if we can create a table from a magic call (for you wizards).
     * hover_striped, bordered_condensed, etc.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
    */
    public static function __callStatic($method, $parameters)
    {
        // Filter table classes
        $method_array = array_intersect(
            explode('_', strtolower($method)),
            array('striped', 'bordered', 'hover', 'condensed'));

        // Define base function
        $function = 'table';

        $parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, 0, 'table-');

        return static::$function($parameters[0]);
    }
}
