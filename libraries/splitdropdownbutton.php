<?php namespace Bootstrapper;

use \HTML;

/**
 * SplitDropdownButton for creating Twitter Bootstrap style Split Dropdown Buttons.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class SplitDropdownButton 
{
	/**
	 * Creates a SplitDropdownButton.
	 *
	 * @param  string  $type
	 * @param  string  $value
	 * @param  array   $list
	 * @param  array   $attributes
	 * @param  bool    $right
	 * @param  bool    $dropup
	 * @param  bool    $autoroute
	 * @return string
	*/
	protected static function show($type, $value, $list, $attributes = array(), $right = false, $dropup = false, $autoroute = true)
	{
		$attributes = Helpers::add_class($attributes, 'btn-group');

		$list_attr = array();
		if($right)
		{
			$list_attr['class'] = 'pull-right';
		}

		if($dropup)
		{
			$attributes['class'] .= ' dropup';
		}

		$html = '<div'.HTML::attributes($attributes).'>';
		$html .= Form::button($value, array('class'=>$type));
		$html .= Form::button('', array('class'=>$type), true);
		$html .= Navigation::dropdown($list, $list_attr, $autoroute);
        $html .= '</div>';

		return $html; 
	}

	/**
	 * Checks call to see if we can create a button from a magic call (for you wizards).
	 * normal, mini_primary, large_warning, danger, etc...
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	*/
	public static function __callStatic($method, $parameters)
	{
		$method_array = explode('_', strtolower($method));

		$type = '';
		foreach ($method_array as $s) 
		{
			if($s != 'normal'){
				$type .= ' btn-'.$s;
			}
		}

		$value = '';
		if(isset($parameters[0]))
		{
			$value = $parameters[0];
		}
		
		//Set default $list and check for a set value
		$list = array();
		if(isset($parameters[1]) && is_array($parameters[1]))
		{
			$list = $parameters[1];		
		}
		else
		{
			throw new \Exception("SplitDropdownButton list is required parameter should be an array of links");
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
				throw new \Exception("SplitDropdownButton attributes parameter should be an array of attributes");
			}
		}

		//Set default $right and check for a set value
		$right = false;
		if(isset($parameters[3]))
		{
			if(is_bool($parameters[3]))
			{
				$right = $parameters[3];
			}
			else
			{
				throw new \Exception("SplitDropdownButton right parameter should be a bool");
			}
		}	

		//Set default $dropup and check for a set value
		$dropup = false;
		if(isset($parameters[4]))
		{
			if(is_bool($parameters[4]))
			{
				$dropup = $parameters[4];
			}
			else
			{
				throw new \Exception("SplitDropdownButton dropup parameter should be a bool");
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
				throw new \Exception("DropdownButton autoroute parameter should be a bool");
			}
		}	

		return static::show($type, $value, $list, $attributes, $right, $dropup, $autoroute);
	}


}