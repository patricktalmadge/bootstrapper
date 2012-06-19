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
		return static::normal($value, $attributes, $hasDropdown);
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
		return static::normal($value, $attributes, $hasDropdown);
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
		if(!isset($attributes['type'])){ $attributes['type'] = 'button'; }
		$attributes = Helpers::add_class($attributes, 'btn');
		$extra = '';
		if ($hasDropdown)
		{
			$attributes = Helpers::add_class($attributes, 'dropdown-toggle');
			$extra = ' <span class="caret"></span>';
			$attributes['data-toggle'] = 'dropdown';
		}
		
		return '<button'.HTML::attributes($attributes).'>'.HTML::entities($value).$extra.'</button>';
	}


	/**
	 * Create a HTML anchor tag styled like a button element.
	 *
	 * @param  string  $value
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function link($value, $url, $attributes = array(), $hasDropdown = false)
	{
		$attributes['href'] = \URL::to($url);

		$attributes = Helpers::add_class($attributes, 'btn');

		$extra = '';
		if ($hasDropdown)
		{
			$attributes = Helpers::add_class($attributes, 'dropdown-toggle');
			$extra = ' <span class="caret"></span>';
			$attributes['data-toggle'] = 'dropdown';
		}
		
		return '<a'.HTML::attributes($attributes).'>'.HTML::entities($value).$extra.'</a>';
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
}