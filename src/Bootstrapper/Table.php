<?php

namespace Bootstrapper;

class Table extends RenderedObject
{

    const TABLE_STRIPED = 'table-striped';
    const TABLE_BORDERED = 'table-bordered';
    const TABLE_HOVER = 'table-hover';
    const TABLE_CONDENSED = 'table-condensed';

    private $type;
    private $contents;
    private $ignores = [];
    private $callbacks = [];

    /**
     * @var bool|array
     */
    private $only = false;

    public function render()
    {
        $attributes = new Attributes(['class' => "table {$this->type}"]);

        $string = "<table {$attributes}>";

        if ($this->contents) {
            $string .= $this->renderContents();
        }

        $string .= '</table>';

        return $string;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function striped()
    {
        $this->setType(self::TABLE_STRIPED);

        return $this;
    }

    public function bordered()
    {
        $this->setType(self::TABLE_BORDERED);

        return $this;
    }

    public function hover()
    {
        $this->setType(self::TABLE_HOVER);

        return $this;
    }

    public function condensed()
    {
        $this->setType(self::TABLE_CONDENSED);

        return $this;
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    private function renderContents()
    {
        $headers = $this->getHeaders();

        $string = '<thead><tr>';
        foreach ($headers as $heading) {
            $string .= "<th>{$heading}</th>";
        }
        $string .= '</tr></thead>';

        $string .= '<tbody>';
        foreach ($this->contents as $item) {
            if (!is_array($item)) {
                $item = $item->getAttributes();
            }
            $string .= $this->renderItem($item, $headers);

        }
        $string .= '</tbody>';

        return $string;
    }

    private function getHeaders()
    {
        $headers = [];
        foreach ($this->contents as $item) {
            if (!is_array($item)) {
                $item = $item->getAttributes();
            }
            foreach (array_keys($item) as $key) {
                if (in_array($key, $this->ignores)) {
                    continue;
                }
                if ($this->only && !in_array($key, $this->only))
                {
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

    private function renderItem($item, $headers)
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


    public function ignore(array $ignores)
    {
        $this->ignores = $ignores;

        return $this;
    }

    public function callback($index, \Closure $function)
    {
        $this->callbacks[$index] = $function;

        return $this;
    }

    public function only(array $only)
    {
        $this->only = $only;

        return $this;
    }
}
