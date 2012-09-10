<?php namespace Bootstrapper;

/**
 * Common helper functions used by Bootstrapper.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Helpers
{
	/**
	 * Function adds the given value to an array. If the key already
	 * exists the value is concatenated to the end of the string.
	 * Mainly used for adding classes.
	 *
	 * @param  array  $array
	 * @param  string  $value
	 * @param  string  $key
	 * @return array
	*/
	public static function add_class($array, $value, $key = 'class')
	{
		$array[$key] = isset($array[$key]) ? $array[$key].' '.$value : $value;

		return $array;
	}

	/**
	 * Function to create a random string of a differing length used for creating IDs
	 *
	 * @param  int  $length
	 * @return string
	*/
	public static function rand_string($length)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		$size = strlen( $chars );
		$str = '';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}

	/**
	 * function used to prime the attributes array for dynamic calls.
	 *
	 * @param  string 	$exclude
	 * @param  array  	$class_array
	 * @param  array  	$params
	 * @param  int  	$index
	 * @param  string  	$extra
	 * @param  string  	$extra_unless
	 * @return array
	*/
	public static function set_multi_class_attributes($exclude, $class_array, $params, $index, $extra = '', $extra_unless = null)
	{
		if(!isset($params[$index])){ $params[$index] = array();}
		if(!isset($params[$index]['class'])){ $params[$index]['class'] = '';}

		foreach ($class_array as $s)
		{
			if($s != $exclude)
			{
				$class = ' '.$extra.$s;
				if (isset($extra_unless) && strpos($s, $extra_unless) !== false)
				{
					$class = ' '.$s;
				}

				$params[$index]['class'] .= $class;
			}
		}

		$params[$index]['class'] = trim($params[$index]['class']);
		return $params;
	}
}