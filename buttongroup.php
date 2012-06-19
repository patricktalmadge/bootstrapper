<?php namespace Bootstrapper;

use \HTML;

/**
 * ButtonGroup for creating Twitter Bootstrap style Buttons groups.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class ButtonGroup 
{

	/**
	 * Puts the ButtonGroup in a checkbox mode.
	 *
	 * @var string
	 */
	const TOGGLE_CHECKBOX = 'checkbox';

	/**
	 * Puts the ButtonGroup in a radio button mode. Allowing only
	 * one button to be selected at a time.
	 *
	 * @var string
	 */
	const TOGGLE_RADIO = 'radio';

	/**
	 * Opens a new ButtonGroup section.
	 * @param string 	$toggle
	 * @param array 	$attributes
	 * @return string
	 */
	public static function open($toggle = null, $attributes = array())
	{
		$validToggles = array(ButtonGroup::TOGGLE_CHECKBOX, ButtonGroup::TOGGLE_RADIO);
		if (isset($toggle) && in_array($toggle, $validToggles))
			$attributes['data-toggle'] = 'buttons-'.$toggle;

		$attributes = Helpers::add_class($attributes, 'btn-group');
		return '<div'.HTML::attributes($attributes).'>';
	}

	/**
	 * Closes the ButtonGroup section.
	 * @return string
	 */
	public static function close()
	{
		return '</div>';
	}
}