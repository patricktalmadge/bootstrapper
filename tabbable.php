<?php namespace bootstrapper;

use \HTML;

/**
 * Tabbable for creating Twitter Bootstrap. Bootstrap JS is required.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Tabbable
{
	// Tab placements.
	const PLACEMENT_ABOVE = 'tabs-above';
	const PLACEMENT_BELOW = 'tabs-below';
	const PLACEMENT_LEFT = 'tabs-left';
	const PLACEMENT_RIGHT = 'tabs-right';


	/**
	 * Generate a Bootstrap tabbable object. 
	 *
	 * @param  array   $list
	 * @param  string  $placement
	 * @param  string  $menu_type @see Navigation
	 * @param  bool    $stacked
	 * @param  array   $attributes
	 * @param  array   $menu_attributes
	 * @param  array   $content_attributes
	 * @param  bool    $autoroute
	 * @return string
	 */
	public static function create($list, $placement = Tabbable::PLACEMENT_ABOVE, $menu_type = Navigation::TYPE_TABS, $stacked = false, $attributes = array(), $menu_attributes = array(), $content_attributes = array(), $autoroute = true)
	{
		$content = array();
		$list = static::normalize($list, $content);

		$tabs = Navigation::menu($list, $menu_type, $stacked, $menu_attributes, $autoroute);

		//Tab content container
		if(!isset($content_attributes['class'])){ $content_attributes['class'] = '';}
		$content_attributes['class'] .= ' tab-content';
		$content = '<div '.HTML::attributes($content_attributes).'>'. implode('', $content).'</div>';

		$html = '<div class="tabbable '.$placement.'"'.HTML::attributes($attributes).'>';
		$html .= $placement === self::PLACEMENT_BELOW ? $content.$tabs : $tabs.$content;
		$html .= '</div>';

		return $html;
	}


	/**
	 * Normalizes the items list and correct urls if any are set.
	 *
	 * @param  array   $items
	 * @param  array   $panes
	 * @param  int 	   $i
	 * @return array
	 */
	protected static function normalize($items, &$panes, &$i = 0)
	{
		$id = Helpers::rand_string(5);
		$tabs = array();

		if (!is_array($items)){ return; }

		foreach ($items as $key => $item)
		{
			$tab = $item;

			if (isset($tab['items']))
			{
				$tab['items'] = static::normalize($tab['items'], $panes, $i);
			}
			else
			{
				if(!isset($tab['content']))
				{
					$tab['content'] = '';
				}

				$tabId = 'tab_'.$id.'_'.$i;
				$tab['attributes'] = array('data-toggle' => 'tab');
				$tab['url'] = '#'.$tabId;

				$class = 'tab-pane';
				if(isset($tab['active']) && $tab['active']) {
					$class .= ' active';
				}

				$panes[] = '<div class="'.$class.'" id="'.$tabId.'">'.$tab['content'].'</div>';

				unset($tab['content']);

				$i++;
			}
			$tabs[] = $tab;
		}

		return $tabs;
	}


	/**
	 * Checks call to see if we can create a tabbable from a magic call (for you wizards).
	 * tabs_above, tabs_left, pills, lists, etc...
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public static function __callStatic($method, $parameters)
	{
		$method_array = explode('_', strtolower($method));

		$list_types = array('tabs', 'pills', 'lists');
		$type_found = array_intersect($method_array, $list_types);

		//Check for placment
		$list_placement = array('above', 'below', 'left', 'right');
		$placement_found = array_intersect($method_array, $list_placement);

		//If placement not found default to above
		if(count($placement_found) > 0 ){
			$placement = $placement_found[key($placement_found)];
		}
		else
		{
			$placement = 'above';
		}

		if(count($type_found) > 0)
		{
			$type = $type_found[key($type_found)];

			//Hack to get around dynamic list call 
			if($type === 'lists') { $type = 'list'; }

			//Check list parameters
			if(!(isset($parameters[0]) && is_array($parameters[0])))
			{
				throw new \Exception("Tabbable requires an array of menu items");
			}

			//Set default $stacked and check for a set value
			$stacked = false;
			if(isset($parameters[1]))
			{
				if(is_bool($parameters[1]))
				{
					$stacked = $parameters[1];
				}
				else
				{
					throw new \Exception("Tabbable stacked parameter should be a bool");
				}
			}

			//Set default $attributes and check for a set value
			$attributes = array();
			if(isset($parameters[2]))
			{
				if(is_array($parameters[2]))
				{
					$attributes = $parameters[2];
				}
				else
				{
					throw new \Exception("Tabbable attributes parameter should be an array of attributes");
				}
			}

			//Set default $menu_attributes and check for a set value
			$menu_attributes = array();
			if(isset($parameters[3]))
			{
				if(is_array($parameters[3]))
				{
					$menu_attributes = $parameters[3];
				}
				else
				{
					throw new \Exception("Tabbable menu_attributes paramter should be an array of menu attributes");
				}
			}

			//Set default $content_attributes and check for a set value
			$content_attributes = array();
			if(isset($parameters[4]))
			{
				if(is_array($parameters[4]))
				{
					$content_attributes = $parameters[4];
				}
				else
				{
					throw new \Exception("Tabbable content_attributes paramter should be an array of attributes");
				}
			}

			//Set default $autoroute and check for a set value
			$autoroute = true;
			if(isset($parameters[5]))
			{
				if(is_bool($parameters[5]))
				{
					$autoroute = $parameters[5];
				}
				else
				{
					throw new \Exception("Tabbable autoroute parameter should be a bool");
				}
			}

			return static::create($parameters[0], 'tabs-'.$placement, 'nav-'.$type, $stacked, $attributes, $menu_attributes, $content_attributes, $autoroute);
		}

		throw new \Exception("Method [$method] does not exist.");
	}
}