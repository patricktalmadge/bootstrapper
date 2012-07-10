<?php namespace Bootstrapper;

use \HTML;

/**
 * Labels for creating Twitter Bootstrap icons.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Icons
{
	/**
	 * Allows magic methods such as Icons::home([attributes]) or Icons::close_white()
	 *
	 * @param  string $method
	 * @param  array  $attributes
	 * @return string
	 */
	public static function __callStatic($method, $parameters)
	{
		// Explode method name
		$method = explode('_', strtolower($method));

		// Get icon name
		$method_array = array(array_get($method, 0));

		// Set facultative white flag
		if(array_get($method, sizeof($method) - 1) == 'white')
			$method_array[] = 'white';

		// Prepend icon- to classes
		$parameters = Helpers::set_multi_class_attributes(null, $method_array, $parameters, 0, 'icon-');

		return '<i'.HTML::attributes($parameters[0]).'></i>';
	}
}