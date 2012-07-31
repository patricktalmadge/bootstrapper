<?php namespace Bootstrapper;

use \HTML;

/**
 * Labels for creating Twitter Bootstrap style Labels.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Labels
{
	// Labels colors
	const NORMAL = '';
	const SUCCESS = 'label-success';
	const WARNING = 'label-warning';
	const IMPORTANT = 'label-important';
	const INFO = 'label-info';
	const INVERSE  = 'label-inverse';


	/**
	 * Create a new Label.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	protected static function show($type = Labels::NORMAL, $message, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'label '.$type);

		return '<span'.HTML::attributes($attributes).'>'.$message.'</span>';
	}

	/**
	 * Create a new Normal Label.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function normal($message, $attributes = array())
	{
		return static::show(Labels::NORMAL, $message, $attributes);
	}

	/**
	 * Create a new Success Label.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function success($message, $attributes = array())
	{
		return static::show(Labels::SUCCESS, $message, $attributes);
	}

	/**
	 * Create a new Warning Label.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function warning($message, $attributes = array())
	{
		return static::show(Labels::WARNING, $message, $attributes);
	}

	/**
	 * Create a new Important Label.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function important($message, $attributes = array())
	{
		return static::show(Labels::IMPORTANT, $message, $attributes);
	}

	/**
	 * Create a new Info Labels instance.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function info($message, $attributes = array())
	{
		return static::show(Labels::INFO, $message, $attributes);
	}

	/**
	 * Create a new Inverse Label.
	 *
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function inverse($message, $attributes = array())
	{
		return static::show(Labels::INVERSE, $message, $attributes);
	}
	
	/**
	 * Create a new custom Label.
	 * This assumes you have created the appropriate css class for the label type.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  array      $attributes
	 * @return string     Label HTML
	 */
	public static function custom($type, $message, $attributes = array())
	{
		$type = 'label-'.(string)$type;
		
		return static::show($type, $message, $attributes);
	}	
}