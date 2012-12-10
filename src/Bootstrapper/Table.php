<?php
namespace Bootstrapper;

use \HTML;

/**
 * Small helper class for creating tables with Bootstrap
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
class Table
{
    /**
     * The current Table instance
     * @var Table
     */
    private static $table = null;

    /**
     * The availables classes for a Table
     * @var array
     */
    private static $classes = array('striped', 'bordered', 'hover', 'condensed');

    // Current table ----------------------------------------------- /

    /**
     * The current table's number of columns
     * @var integer
     */
    private $numberColumns = 50;

    /**
     * The current table body in memory
     * @var string
     */
    private $tbody = array();

    /**
     * The rows to be ignored in the next body to come
     * @var array
     */
    private $ignore = array();

    /**
     * The order in which the columns are to be printed out
     * @var array
     */
    private $order = array();

    /**
     * Columns to append/replace in the current body
     * @var array
     */
    private $columns = array();

    /**
     * The table's attributes
     * @var array
     */
    private $attributes = array();

    //////////////////////////////////////////////////////////////////
    ////////////////////////// STATIC FUNCTIONS //////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Checks call to see if we can create a table from a magic call (for you wizards).
     * hover_striped, bordered_condensed, etc.
     *
     * @param string $method     Method name
     * @param array  $parameters Method parameters
     *
     * @return mixed
    */
    public static function __callStatic($method, $parameters)
    {
        // Opening a table
        if (str_contains($method, 'open') or $method == 'open') {
            $method  = strtolower($method);
            $classes = explode('_', $method);
            $method  = array_pop($classes);

            // Fallback to default type if defined
            if(sizeof($classes) == 0) $classes = Config::get('table.classes');

            // Filter table classes
            $classes = array_intersect($classes, static::$classes);
            $attributes = Helpers::set_multi_class_attributes($method, $classes, $parameters, 0, 'table-');
            $attributes = array_get($attributes, 0);

            static::$table = new static($attributes);

            return static::$table->open();
        }

        // Set default function
        if(!$method) $method = 'table';

        // Use cases
        switch ($method) {
            case 'close':
                $close = static::table()->close();
                static::$table = null;

                return $close;
                break;
            default:
                return call_user_func_array(array(static::table(), $method), $parameters);
                break;
        }
    }

    /**
     * Pass a method to the Table instance
     *
     * @param  string $method     The method to call
     * @param  array  $parameters Its parameters
     * @return Table  A Table instance
     */
    public function __call($method, $parameters)
    {
        // If trying to set a column
        if (!method_exists(static::$table, $method)) {
            $this->$method = $parameters[0];

            return $this;
        }

        // Else, call the available method
        return call_user_func_array(array(static::$table, $method), $parameters);
    }

    /**
     * Dynamically set a column's content
     *
     * @param string $column  The column's name and classes
     * @param mixed  $content Its content
     */
    public function __set($column, $content)
    {
        // List known keys
        $columns = array_get($this->tbody, key($this->tbody));
        $columns = array_keys(is_object($columns) ? $columns->attributes : $columns);

        // If we're not replacing something, we're creating, assume classes
        if (!in_array($column, $columns)) {
            $column = str_replace('_', ' ', $column);
        }

        // Store Closure/content
        $this->columns[$column] = $content;
    }

    public static function table()
    {
        return static::$table ?: new static;
    }

    //////////////////////////////////////////////////////////////////
    ////////////////////////// TABLE INSTANCE ////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Creates a Table instance
     *
     * @param array $attributes An array of attributes to create for the table
     */
    private function __construct($attributes = array())
    {
        $this->attributes = Helpers::add_class($attributes, 'table');
    }

    /**
     * Creates a table opening tag
     *
     * @param  array  $attributes An array of attributes
     * @return string A table opening tag
     */
    private function open()
    {
        return '<table'.HTML::attributes($this->attributes).'>';
    }

    /**
     * Creates a table <thead> tag
     *
     * @return string A <thead> tag prefilled with rows
     */
    private function headers()
    {
        $headers = func_get_args();
        if(sizeof($headers) == 1 and is_array($headers[0])) $headers = $headers[0];

        // Open headers
        $thead = '<thead>'.PHP_EOL;

        // Store the number of columns in this table
        $this->numberColumns = sizeof($headers);

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
     * Set the content to be used for the next body
     *
     * @param  mixed $content Can be results from a Query or a bare array
     * @return Table The current table instance
     */
    private function body($content)
    {
        if(!$content) return false;

        $this->tbody = $content;

        return $this;
    }

    /**
     * Ignore certains rows in the body to come
     *
     * @return Table The current table instance
     */
    private function ignore()
    {
        $this->ignore = func_get_args();

        return $this;
    }

    /**
     * Iterate the columns in a certain order in the body to come
     */
    private function order()
    {
        $this->order = func_get_args();

        return $this;
    }

    /**
     * Outputs the current body in memory
     *
     * @return string A <tbody> with content
     */
    public function __toString()
    {
        if(!$this->tbody) return false;

        // Fetch ignored columns
        if (!$this->ignore) $this->ignore = Config::get('table.ignore');

        // Fetch variables
        $content = $this->tbody;

        // Open table body
        $html = '<tbody>';

        // Iterate through the data
        foreach ($content as $row) {

            $html .= '<tr>';
            $columnCount = 0;
            $data = is_object($row) ? $row->attributes : $row;

            // Reorder columns if necessary
            if ($this->order) {
                $data = array_merge(array_flip($this->order), $data);
            }

            // Read the data row with ignored keys
            foreach ($data as $column => $value) {
                if(in_array($column, (array) $this->ignore)) continue;

                // Check for replacing columns
                $replace = array_get($this->columns, $column);
                if ($replace) {
                    $value = is_callable($replace) ? $replace($row) : $replace;
                    $value = static::replace_keywords($value, $data);
                }

                $columnCount++;
                $html .= static::appendColumn($column, $value);
            }

            // Add supplementary columns
            if($this->columns)
                foreach ($this->columns as $class => $column) {

                // Check for replacing columns
                if(array_key_exists($class, $data)) continue;

                // Calculate closures
                if(is_callable($column)) $column = $column($row);

                // Parse and decode content
                $column = static::replace_keywords($column, $data);
                $column = HTML::decode($column);

                // Wrap content in a <td> tag if necessary
                $columnCount++;
                $html .= static::appendColumn($class, $column);
            }
            $html .= '</tr>';

            // Save new number of columns
            if($columnCount > $this->numberColumns) $this->numberColumns = $columnCount;
        }

        $html .= '</tbody>';

        // Empty data from this body
        $this->ignore  = array();
        $this->columns = array();
        $this->tbody   = null;

        return $html;
    }

    /**
     * Render a full_row with <th> tags
     *
     * @param string $content    The content to display
     * @param array  $attributes An array of attributes
     *
     * @return string A table opening tag
     */
    private function full_header($content, $attributes = array())
    {
        return static::table()->full_row($content, $attributes, true);
    }

    /**
     * Creates a table-wide row to display content
     *
     * @param string $content    The content to display
     * @param array  $attributes The rows's attributes
     * @param bool   $asHeaders  Draw row as header
     *
     * @return string A single-column row spanning all table
     */
    private function full_row($content, $attributes = array(), $asHeaders = false)
    {
        // Add a class for easy styling
        $attributes = Helpers::add_class($attributes, 'full-row');
        $tag = $asHeaders ? 'th' : 'td';

        return
        '<tr' .HTML::attributes($attributes). '>
            <' .$tag. ' colspan="' .$this->numberColumns. '">' .$content. '</' .$tag. '>
        </tr>';
    }

    /**
     * Closes current table
     *
     * @return string A </table> closing tag
     */
    private function close()
    {
        return '</table>';
    }

    //////////////////////////////////////////////////////////////////
    ////////////////////////////// HELPERS ///////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Wrap a supplementary column in a column if it isn't
     *
     * @param  string $name  The column's name
     * @param  string $value Its value
     * @return string A <td> tag
     */
    private static function appendColumn($name, $value)
    {
        return starts_with($value, '<td')
            ? $value
            : '<td class="column-'.$name.'">' .$value. '</td>';
    }

    /**
     * Replace keywords with data in a string
     *
     * @param string $string A string with Laravel patterns (:key)
     * @param array  $data   An array of data to fetch from
     *
     * @return string The modified string
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
}
