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
    public abstract function render();

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
     * Set a tooltip on the object
     * @param $message
     * @param array $options animation, container, delay, html, placement, selector, template, title, trigger, viewport
     * @see http://getbootstrap.com/javascript/#tooltips-usage
     * @return $this
     */
    public function withTooltip($message, array $options = [])
	{
        $attributes = ['title'=>$message,'data-toggle'=>'tooltip'];
		
        foreach($options as $key => $value){
            $attributes['data-'.$key] = $value;
		}
			
        return $this->withAttributes($attributes);
    }
} 
