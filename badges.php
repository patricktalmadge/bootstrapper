<?php namespace Bootstrapper;

use \HTML;

/**
 * Badges for creating Twitter Bootstrap style Badges.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Badges 
{
	// Badge colors
	const NORMAL = '';
	const SUCCESS = 'badge-success';
	const WARNING = 'badge-warning';
	const IMPORTANT = 'badge-important';
	const INFO = 'badge-info';
	const INVERSE  = 'badge-inverse';

	/**
	 * Create a new Badge.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	protected static function show($type, $message, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'badge '.$type);

		return '<span'.HTML::attributes($attributes).'>'.$message.'</span>';
	}

	/**
	 * Create a new Normal Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function normal($message, $attributes = array())
	{
		return static::show(Badges::NORMAL, $message, $attributes);
	}

	/**
	 * Create a new Success Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function success($message, $attributes = array())
	{
		return static::show(Badges::SUCCESS, $message, $attributes);
	}

	/**
	 * Create a new Warning Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function warning($message, $attributes = array())
	{
		return static::show(Badges::WARNING, $message, $attributes);
	}

	/**
	 * Create a new Important Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function important($message, $attributes = array())
	{
		return static::show(Badges::IMPORTANT, $message, $attributes);
	}

	/**
	 * Create a new Info Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function info($message, $attributes = array())
	{
		return static::show(Badges::INFO, $message, $attributes);
	}

	/**
	 * Create a new Inverse Badge.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function inverse($message, $attributes = array())
	{
		return static::show(Badges::INVERSE, $message, $attributes);
	}
	
	/**
	 * Create a new custom Badge.
	 * This assumes you have created the appropriate css class for the label type.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Badge HTML
	 */
	public static function custom($type, $message, $attributes = array())
	{
		$type = 'badge-'.(string)$type;

		return static::show($type, $message, $attributes);
	}
}