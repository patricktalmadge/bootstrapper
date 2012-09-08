<?php namespace Bootstrapper;

use \HTML;

/**
 * Buttons methods for creating Twitter Bootstrap buttons.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Buttons
{
	/**
	 * The current button in memory
	 * @var array
	 */
	private static $output = array();

	/**
	 * Stores the current button for future output
	 *
	 * @param  string  $type        A button type
	 * @param  string  $value       Its text value
	 * @param  array   $attributes  An array of attributes
	 * @param  boolean $hasDropdown Whether the button has a dropdown
	 */
	public static function storeButton($type, $value, $attributes, $hasDropdown)
	{
		static::$output = array(
			'type'        => $type,
			'value'       => $value,
			'attributes'  => $attributes,
			'hasDropdown' => $hasDropdown,
		);
	}

	/**
	 * Create a HTML submit input element.
	 * Overriding the default input submit button from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function submit($value, $attributes = array(), $hasDropdown = false)
	{
		$attributes['type'] = 'submit';
		static::storeButton('normal', $value, $attributes, $hasDropdown);

		return new Buttons;
	}

	/**
	 * Create a HTML reset input element.
	 * Overriding the default input reset button from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function reset($value, $attributes = array(), $hasDropdown = false)
	{
		$attributes['type'] = 'reset';
		static::storeButton('normal', $value, $attributes, $hasDropdown);

		return new Buttons;
	}

	/**
	 * Create a HTML button element.
	 * Overriding the default button to add the correct class from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function normal($value, $attributes = array(), $hasDropdown = false)
	{
		static::storeButton('normal', $value, $attributes, $hasDropdown);

		return new Buttons;
	}

	/**
	 * Create a HTML anchor tag styled like a button element.
	 *
	 * @param  string  $value
	 * @param  string  $url
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function link($value, $url, $attributes = array(), $hasDropdown = false)
	{
		$attributes['href'] = \URL::to($url);
		static::storeButton('link', $value, $attributes, $hasDropdown);

		return new Buttons;
	}

	/**
	 * Adds an icon to the next button
	 *
	 * @param  string  $icon       The name of the icon to call
	 * @param  array   $attributes Attributes to pass to the generated icon
         * @param  boolean $prependIcon Whether we should prepend the icon, or append it
	 */
	public function with_icon($icon, $attributes = array(), $prependIcon = true)
	{
		// Call Icons to create the icon
		$icon = Icons::make($icon);

		// If there was no text, just use the icon, else put a space between
		$value = static::$output['value'];
		if(empty($value)) $value = $icon;
		else {
			$value = $prependIcon
      	? $icon.  ' ' .$value
				: $value. ' ' .$icon;
		}

		// Store modified value
		static::$output['value'] = $value;

		return new Buttons;
	}

	/**
	 * Alias for with_icon
	 */
	public function prepend_with_icon($icon, $attributes = array())
	{
    return $this->with_icon($icon, $attributes);
	}

	/**
	 * Alias for with_icon with $prependIcon to false
	 */
	public function append_with_icon($icon, $attributes = array())
	{
		return $this->with_icon($icon, $attributes, false);
	}

	/**
	 * Checks call to see if we can create a button from a magic call (for you wizards).
	 * success_button, mini_primary_button, large_warning_submit, danger_reset, etc...
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	*/
	public static function __callStatic($method, $parameters)
	{
		$method_array = explode('_', strtolower($method));

		$btn_types = array('normal', 'submit', 'reset', 'link');
		$type_found = array_intersect($method_array, $btn_types);

		if(count($type_found) > 0)
		{
			$function = $type_found[key($type_found)];

			//Set default attributes index
			$attr_index = $function != 'link' ? 1 : 2;

			$parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, $attr_index, 'btn-', 'disabled');
			if(in_array('disabled', $method_array))
			{
				$parameters[$attr_index]['disabled'] = 'disabled';
			}

			return call_user_func_array('static::'.$function, $parameters);
		}
	}

	/**
	 * Prints the current button in memory
	 * @return string A button
	 */
	public function __toString()
	{
		// Gather variables
		extract(static::$output);

		// Add btn to classes and fallback type
		if(!isset($attributes['type'])) $attributes['type'] = 'button';
		$attributes = Helpers::add_class($attributes, 'btn');

		// Modify output if we have a dropdown
		$extra = '';
		if ($hasDropdown)
		{
			$attributes = Helpers::add_class($attributes, 'dropdown-toggle');
			$extra = ' <span class="caret"></span>';
			$attributes['data-toggle'] = 'dropdown';
		}

		// Write output according to tag
		switch($type) {
			case 'link':
				return '<a'.HTML::attributes($attributes).'>'.(string)$value.$extra.'</a>';
				break;
			default:
    		return '<button'.HTML::attributes($attributes).'>'.(string)$value.$extra.'</button>';
				break;
		}
	}
}
