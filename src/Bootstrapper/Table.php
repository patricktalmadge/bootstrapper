<?php
/**
 * Bootstrapper Table class
 */

namespace Bootstrapper;

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
     * @var string The type of the table
     */
    protected $type;

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
     * Renders the table
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "table {$this->type}"
            ]
        );

        $string = "<table {$attributes}>";

        $string .= $this->renderHeaders();

        if ($this->footer)
        {
            $string .= $this->renderFooter();
        }

        if ($this->contents) {
            $string .= $this->renderContents();
        }

        $string .= '</table>';

        return $string;
    }

    /**
     * Sets the table type
     *
     * @param string $type The type of the table
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the table to be striped
     *
     * @return $this
     */
    public function striped()
    {
        $this->setType(self::TABLE_STRIPED);

        return $this;
    }

    /**
     * Sets the table to be bordered
     *
     * @return $this
     */
    public function bordered()
    {
        $this->setType(self::TABLE_BORDERED);

        return $this;
    }

    /**
     * Sets the table to have an active hover state
     *
     * @return $this
     */
    public function hover()
    {
        $this->setType(self::TABLE_HOVER);

        return $this;
    }

    /**
     * Sets the table to be condensed
     *
     * @return $this
     */
    public function condensed()
    {
        $this->setType(self::TABLE_CONDENSED);

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
            if (!is_array($item)) {
                $item = $item->getAttributes();
            }

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
            if (!is_array($item)) {
                $item = $item->getAttributes();
            }

            foreach (array_keys($item) as $key) {
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
        foreach ($headers as $heading) {
            $value = isset($item[$heading]) ? $item[$heading] : '';
            if (isset($this->callbacks[$heading])) {
                $value = $this->callbacks[$heading]($value, $item);
            }
            $string .= "<td>{$value}</td>";
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
            $string .= "<th>{$heading}</th>";
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
}
