<?php namespace bootstrapper;

use \HTML;

/**
 * Typeahead for creating Twitter Bootstrap style Typeahead.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Typeahead 
{


	/**
	 * Creates a new Typeahead instance.
	 *
	 * @param  array    $source
	 * @param  int     	$items
	 * @param  array    $attributes
	 * @return Typeahead
	 */
	public static function create($source, $items = 8, $attributes = array())
	{
		$attributes['type'] = "text"; 
		$attributes['data-source'] = json_encode($source);
		$attributes['data-items'] = $items;
		$attributes['data-provide'] = "typeahead";

		return '<input'.HTML::attributes($attributes).'>';
	}
}