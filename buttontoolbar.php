<?php namespace Bootstrapper;

use \HTML;

/**
 * ButtonToolbar for creating Twitter Bootstrap style Buttons toolbars.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class ButtonToolbar 
{

	/**
	 * Opens a new ButtonToolbar section.
	 * @param array 	$attributes
	 * @return string
	 */
	public static function open($attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'btn-toolbar');
		return '<div'.HTML::attributes($attributes).'>';
	}


	/**
	 * Closes the ButtonToolbar section.
	 * @return string
	 */
	public static function close()
	{
		return '</div>';
	}
}