<?php namespace Bootstrapper;

use \HTML;

/**
 * Breadcrumbs for creating Twitter Bootstrap style breadcrumbs.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Breadcrumbs 
{
	/**
	 * The values that represnts the Breadcrumb separator.
	 *
	 * @var array
	 */
	public static $separator = '/';

	/**
	 * Creates the a new Breadcrumb.
	 * @param array 	$links
	 * @param array 	$attributes
	 * @return string
	 */
	public static function create($links, $attributes = array())
	{
		if (empty($links))
			return;

		$l = array();

		foreach ($links as $label => $url)
		{
			if (is_string($label) || is_array($url))
			{
				$l[] = static::renderItem('<a href="'.$url.'">'.$label.'</a>');
			}
			else
				$l[] = static::renderItem($url, true);
		}

		$attributes = Helpers::add_class($attributes, 'breadcrumb');

		$html = '<ul'.HTML::attributes($attributes).'>';
		$html .= implode('', $l);
		$html .= '</ul>';
		return $html;
	}


	/**
	 * Renders a breadcrumb item.
	 * @param string 	$content
	 * @param boolean 	$active
	 * @return string
	 */
	protected static function renderItem($content, $active = false)
	{
		$separator = !$active ? '<span class="divider">'.static::$separator.'</span>' : '';
		
		$class = $active ? ' class="active"' : '';

		$html = '<li'.$class.'>';
		$html .= $content.$separator;
		$html .= '</li>';
		return $html;
	}
}