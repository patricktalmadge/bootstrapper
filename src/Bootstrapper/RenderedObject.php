<?php
namespace Bootstrapper;

/**
 * Rendered Object abstract class
 *
 * @package Bootstrapper
 */
abstract class RenderedObject
{

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
    public abstract function render();

} 
