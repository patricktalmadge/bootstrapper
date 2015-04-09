<?php
/**
 * Bootstrapper base class for objects
 */
namespace Bootstrapper;

/**
 * Rendered Object abstract class
 *
 * @package Bootstrapper
 */
abstract class RenderedObject
{

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Calls the render method on the object. If an exception is thrown,
     * it catches it and displays an error message
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (\Exception $e) {
            $class = get_class($e);
            return "<div><p class='bg-warning text-warning'>An exception of"
            . " type <code>{$class}</code> was thrown with the message:"
            . " <code>{$e->getMessage()}</code></div>";
        }
    }

    /**
     * Renders the object
     *
     * @return string
     */
    abstract public function render();

    /**
     * Set the attributes of the object
     *
     * @param array $attributes The attributes to use
     * @return $this
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes = array_merge($attributes, $this->attributes);

        return $this;
    }

    /**
     * Adds the given classes to attributes
     *
     * @param array $classes
     * @return $this
     */
    public function addClass($classes)
    {
        if (!is_array($classes)) {
            throw new \InvalidArgumentException('Add class must take an array');
        }

        $classes = implode(' ', $classes);

        if (!isset($this->attributes['class'])) {
            $this->attributes['class'] = $classes;
        } else {
            $this->attributes['class'] .= " $classes";
        }

        return $this;
    }
}
