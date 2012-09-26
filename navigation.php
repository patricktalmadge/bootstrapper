<?php namespace Bootstrapper;

use \HTML;

/**
 * Navigation for creating Twitter Bootstrap menus.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Navigation
{
	// Menu types.
	const TYPE_UNSTYLED = '';
	const TYPE_TABS = 'nav-tabs';
	const TYPE_PILLS = 'nav-pills';
	const TYPE_LIST = 'nav-list';	


	/**
	 * Generates a nav menu and any dropdown if the $list array contains any dropdown objects. 
	 *
	 * @param  array   $list
	 * @param  string  $type
	 * @param  bool    $stacked
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function menu($list, $type = Navigation::TYPE_UNSTYLED, $stacked = false, $attributes = array(), $autoroute = true)
	{
		$html = '';

		if(isset($type))
		{
			$attributes = Helpers::add_class($attributes, 'nav '.$type);
		}

		if ($type !== Navigation::TYPE_LIST && $stacked)
		{	
			$attributes = Helpers::add_class($attributes, 'nav-stacked');
		}

		if (count($list) == 0) 
		{
			return $html;
		}

		foreach ($list as $item)
		{
			$icon = isset($item['icon']) ? $item['icon'] : null;

			if (!is_array($item))
			{
				// if string is ||| use vertical divider else use normal divider
				$html .= $item === '|||' ? '<li class="divider-vertical"></li>' : '<li class="divider"></li>';
			}
			else if (isset($item['header']))
			{
				$html .= '<li class="nav-header">'.HTML::entities($item['header']).'</li>';
			}
			else if (isset($item['items']))
			{
				$html .= '<li class="dropdown '.static::getClasses($item, false, $autoroute).'">';
				$html .= static::link($item['url'], $item['label'].' <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'), false, $icon);
				$html .= static::dropdown($item['items']);
				$html .= '</li>';
			}
			else
			{
				if(!isset($item['attributes']))
				{
					$item['attributes'] = array();
				}

				$html .= '<li '.static::getClasses($item, true, $autoroute).'>'.static::link($item['url'], $item['label'], $item['attributes'], true, $icon).'</li>';
			}
		}

		return '<ul'.HTML::attributes($attributes).'>'.$html.'</ul>';
	}

	/**
	 * Creates a Bootstrap plan unstyled menu.
	 *
	 * @param  array   $list
	 * @param  bool    $stacked	 
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function unstyled($list, $stacked = false, $attributes = array(), $autoroute = true)
	{
		return static::menu($list, Navigation::TYPE_UNSTYLED, $stacked, $attributes, $autoroute);
	}

	/**
	 * Creates a Bootstrap Tabs menu.
	 *
	 * @param  array   $list
	 * @param  bool    $stacked	 
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function tabs($list, $stacked = false, $attributes = array(), $autoroute = true)
	{
		return static::menu($list, Navigation::TYPE_TABS, $stacked, $attributes, $autoroute);
	}

	/**
	 * Creates a Bootstrap Pills menu.
	 *
	 * @param  array   $list
	 * @param  bool    $stacked	 
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function pills($list, $stacked = false, $attributes = array(), $autoroute = true)
	{
		return static::menu($list, Navigation::TYPE_PILLS, $stacked, $attributes, $autoroute);
	}

	/**
	 * Creates a Bootstrap Lists menu.
	 *
	 * @param  array   $list
	 * @param  bool    $stacked	 
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function lists($list, $stacked = false, $attributes = array(), $autoroute = true)
	{
		return static::menu($list, Navigation::TYPE_LIST, $stacked, $attributes, $autoroute);
	}

	/**
	 * Creates a Bootstrap Dropdown menu.
	 *
	 * @param  array   $list
	 * @param  array   $attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function dropdown($list, $attributes = array(), $autoroute = true)
	{
		$attributes = Helpers::add_class($attributes, 'dropdown-menu');

		return static::menu($list, null, false, $attributes, $autoroute);
	}

	/**
	 * Creates the class element for the menu item.
	 *
	 * @param  array   $item
	 * @param  bool    $with_class
	 * @param  bool    $autoroute
	 * @return string
	 */
	protected static function getClasses($item, $with_class = true, $autoroute = true)
	{

		$class = '';
		if((isset($item['active']) && $item['active']) || ($autoroute && \URL::current() == $item['url']))
		{
			$class = 'active';
		}

		$class .= isset($item['align']) ? ' '.$item['align'] : '';

		if(strlen($class) > 0 && $with_class)
		{
			$class = 'class="'.$class.'"';
		}
		return $class;
	}

	/**
	 * Generates a link without doing a getting the full url from Laravel 
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @param  bool    $encode
	 * @param  string  $icon
	 * @return string
	 */
	protected static function link($url, $title, $attributes = array(), $encode = true, $icon = null)
	{
		if($encode)
		{
			$title = HTML::entities($title);
		}

		if(isset($icon))
		{
			$title = '<i class="icon-'.$icon.'"></i> '.$title;
		}

		return '<a href="'.$url.'"'.HTML::attributes($attributes).'>'.$title.'</a>';
	}
}