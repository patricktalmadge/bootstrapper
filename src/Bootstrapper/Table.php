<?php
/**
 * Bootstrapper Table class
 */

namespace Bootstrapper;

use Bootstrapper\Interfaces\TableInterface;

/**
 * Creates Bootstrap 3 compliant tables
 *
 * @package Bootstrapper
 */
class Table extends RenderedObject
{

    /**
     * Constant for striped tables
     */
    const TABLE_STRIPED = 'table-striped';

    /**
     * Constant for bordered tables
     */
    const TABLE_BORDERED = 'table-bordered';

    /**
     * Constant for tables that have an active hover state
     */
    const TABLE_HOVER = 'table-hover';

    /**
     * Constant for condensed tables
     */
    const TABLE_CONDENSED = 'table-condensed';

    /**
     * @var string The types of the table
     */
    protected $types = [];

    /**
     * @var string A string to put content in to the footer of the table
     */
    protected $footer;

    /**
     * @var mixed The contents of the table
     */
    protected $contents = [];

    /**
     * @var array A list of columns to ignore
     */
    protected $ignores = [];

    /**
     * @var array A list of callbacks, of the form 'column' => function()
     */
    protected $callbacks = [];

    /**
     * @var bool|array An array of columns to get. False if none.
     */
    protected $only = [];

    /**
     * @var array An array of classes to apply to body tds
     */
    protected $bodyCellClasses = [];

    /**
     * @var  array An array of classes, of the form 'column' => 'class1 class2' (space delimitied)
     */
    protected $columnClasses = [];

    /**
     * Renders the table
     *
     * @return string
     */
    public function render()
    {
        $tableClasses = implode(' ', $this->types);

        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "table {$tableClasses}"
            ]
        );

        $string = "<table {$attributes}>";

        $string .= $this->renderHeaders();

        if ($this->footer) {
            $string .= $this->renderFooter();
        }

        if ($this->contents) {
            $string .= $this->renderContents();
        }

        $string .= '</table>';

        return $string;
    }

    /**
     * Adds a type to the table if not already present.
     * @param string $type The type to add to the table
     */
    private function addType($type)
    {
        if (!in_array($type, $this->types, true)) {
            $this->types[] = $type;
        }

        return $this;
    }

    /**
     * Sets the table to be striped
     *
     * @return $this
     */
    public function striped()
    {
        $this->addType(self::TABLE_STRIPED);

        return $this;
    }

    /**
     * Sets the table to be bordered
     *
     * @return $this
     */
    public function bordered()
    {
        $this->addType(self::TABLE_BORDERED);

        return $this;
    }

    /**
     * Sets the table to have an active hover state
     *
     * @return $this
     */
    public function hover()
    {
        $this->addType(self::TABLE_HOVER);

        return $this;
    }

    /**
     * Sets the table to be condensed
     *
     * @return $this
     */
    public function condensed()
    {
        $this->addType(self::TABLE_CONDENSED);

        return $this;
    }

    /**
     * Sets the contents of the table
     *
     * @param array|Traversable $contents The contents of the table. We expect
     *                                    either an array of arrays or an
     *                                    array of eloquent models
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Renders the contents of the table
     *
     * @return string
     */
    private function renderContents()
    {
        $headers = $this->getHeaders();

        $string = '<tbody>';
        foreach ($this->contents as $item) {
            $string .= $this->renderItem($item, $headers);
        }

        $string .= '</tbody>';

        return $string;
    }

    /**
     * Gets the headers of the contents
     *
     * @return array
     */
    private function getHeaders()
    {
        if ($this->only) {
            return $this->only;
        }

        $headers = [];
        foreach ($this->contents as $item) {
            $keys = $this->getKeysForItem($item);

            foreach ($keys as $key) {
                if (in_array($key, $this->ignores)) {
                    continue;
                }
                if ($this->only && !in_array($key, $this->only)) {
                    continue;
                }
                if (!in_array($key, $headers)) {
                    $headers[] = $key;
                }
            }
        }

        foreach (array_keys($this->callbacks) as $key) {
            if (in_array($key, $this->ignores)) {
                continue;
            }

            if (!in_array($key, $headers)) {
                $headers[] = $key;
            }
        }

        return $headers;
    }

    /**
     * Renders an item
     *
     * @param mixed $item    The item to render
     * @param array $headers The headers to use
     * @return string
     */
    private function renderItem($item, array $headers)
    {
        $string = '<tr>';
        $tdClasses = implode(' ', $this->bodyCellClasses);

        foreach ($headers as $heading) {
            $value = $this->getValueForItem($item, $heading);

            if (isset($this->columnClasses[$heading])) {
                $classes = rtrim($this->columnClasses[$heading] . ' ' . $tdClasses);
                $string .= "<td class='{$classes}'>{$value}</td>";
            } else {
                $string .= empty($tdClasses) ? "<td>{$value}</td>" : "<td class='{$tdClasses}'>{$value}</td>";
            }
        }
        $string .= '</tr>';

        return $string;
    }


    /**
     * Creates a list of columns to ignore
     *
     * @param array $ignores The ignored columns
     * @return $this
     */
    public function ignore(array $ignores)
    {
        $this->ignores = $ignores;

        return $this;
    }

    /**
     * Adds a callback
     *
     * @param string   $index    The column name for the callback
     * @param callable $function The callback function,
     *                           which should be of the form
     *                           function($column, $row).
     * @return $this
     */
    public function callback($index, \Closure $function)
    {
        $this->callbacks[$index] = $function;

        return $this;
    }

    /**
     * Sets which columns we can return
     *
     * @param array $only
     * @return $this
     */
    public function only(array $only)
    {
        $this->only = $only;

        return $this;
    }

    private function renderHeaders()
    {
        $headers = $this->getHeaders();

        if (empty($headers)) {
            return '';
        }

        $string = '<thead><tr>';
        foreach ($headers as $heading) {
            if (isset($this->columnClasses[$heading])) {
                $string .= "<th class='{$this->columnClasses[$heading]}'>{$heading}</th>";
            } else {
                $string .= "<th>{$heading}</th>";
            }
        }
        $string .= '</tr></thead>';

        return $string;
    }

    /**
     * Sets content to be rendered in to the table footer
     *
     * @param string $footer
     * @return $this
     */
    public function withFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Renders the footer
     *
     * @return string
     */
    private function renderFooter()
    {
        return "<tfoot>{$this->footer}</tfoot>";
    }

    private function getKeysForItem($item)
    {
        if (is_array($item)) {
            return array_keys($item);
        }

        if ($item instanceof TableInterface) {
            return $item->getTableHeaders();
        }

        // Let the user know that the TableInterface will soon be the
        // only way to use tables in a future version of Bootstrapper
        trigger_error(
            'An object that does not implement the TableInterface '
            . 'was passed to a table. This is depreciated and will be removed in '
            . 'a future version of Bootstrapper',
            E_USER_DEPRECATED
        );

        // Handles eloquent models
        if (is_callable([$item, 'getAttributes'])) {
            return array_keys($item->getAttributes());
        }

        // Default fallback
        return get_object_vars($item);
    }

    private function getValueForItem($item, $heading)
    {
        if (is_array($item)) {
            $value = isset($item[$heading]) ? $item[$heading] : '';
        } elseif ($item instanceof TableInterface) {
            $value = $item->getValueForHeader($heading);
        } else {
            $value = $item->$heading;
        }

        if (isset($this->callbacks[$heading])) {
            $value = $this->callbacks[$heading]($value, $item);
        }

        return $value;
    }

    /**
     * Uses given class(es) on body TDs.
     * @param  mixed $classes The class(es) to apply.
     * @return $this
     */
    public function withBodyCellClass($classes)
    {
        if (is_array($classes)) {
            $this->bodyCellClasses = $classes;
        } else {
            $this->bodyCellClasses = [ $classes ];
        }

        return $this;
    }

    public function withClassOnCellsInColumn($columns, $classes)
    {
        if (!is_array($columns)) {
            $columns = [ $columns ];
        }

        if (is_array($classes)) {
            $classes = implode(' ', $classes);
        }

        foreach ($columns as $column) {
            $this->columnClasses[$column] = $classes;
        }

        return $this;
    }
}
