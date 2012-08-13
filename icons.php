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
	 * @param  array  $parameters
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

    /**
     * Return icon HTML.
     * Overload via __callStatic() allows calls like Icons::check() for a checkmark icon, 
     * but it does not work well for hyphenated icons like paper-clip or folder-open. 
     * Therefore, this method is recommended for general use.  
     * 
     * Usage:
     * <code>
     * <?php
     * echo Icons::make('folder-open');
     * echo Icons::make('film-white');
     * return Icons::make('paper-clip',array('class'=>'attachment','data-toggle'=>'modal'));
     * ?>
     * </code>
     * 
     * @static
     * @param $icon_class
     * @param null $parameters
     * @return string
     */
    public static function make($icon_class, $parameters = null)
    {
        return static::__callStatic($icon_class, $parameters);
    }
}