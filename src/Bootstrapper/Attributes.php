<?php
/**
 * Bootstrapper Attributes class
 */

namespace Bootstrapper;

/**
 * Simple attributes bag
 *
 * @package Bootstrapper
 */
class Attributes implements \ArrayAccess
{

    /**
     * The attributes
     *
     * @var array
     */
    protected $attributes;

    /**
     * Creates a new instance of the attributes
     *
     * @param array $attributes
     * @param array $defaults
     */
    public function __construct(array $attributes, array $defaults = [])
    {
        $this->attributes = array_merge($defaults, $attributes);
        if (isset($attributes['class']) && isset($defaults['class'])) {
            $this->attributes['class'] = trim(
                "{$defaults['class']} {$attributes['class']}"
            );
        }
    }

    /**
     * Renders the HTML attributes
     *
     * @return string
     */
    public function __toString()
    {
        $string = "";
        foreach ($this->attributes as $param => $value) {
            if ($value == '') {
                continue;
            }
            if (is_string($param)) {
                $value = str_replace("'", "\'", $value);
                $value = htmlentities(trim($value));
                $string .= "{$param}='{$value}' ";
            } else {
                $value = htmlentities(trim($value));
                $string .= "{$value} ";
            }
        }

        return trim($string);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     * @return boolean true on success or false on failure.
     *                      </p>
     *                      <p>
     *                      The return value will be casted to boolean if
     *                      non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->attributes);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->attributes[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * Adds to to the class attributes
     *
     * @param $class string The class to add
     * @return $this
     */
    public function addClass($class)
    {
        $this->attributes['class'] = isset($this->attributes['class']) ?
            trim($this->attributes['class']) . " {$class}" :
            $class;

        return $this;
    }
}
