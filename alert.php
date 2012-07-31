<?php namespace Bootstrapper;

use \HTML;

/**
 * Alert for creating Twitter Bootstrap style alerts.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Alert 
{
	// Alert styles
	const SUCCESS = 'alert-success';
	const INFO    = 'alert-info';
	const WARNING = 'alert-warning';
	const ERROR   = 'alert-error';
	const DANGER  = 'alert-danger';

	/**
	 * Create a new Alert.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	protected static function show($type, $message, $enable_close = true, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'alert '.$type);

		$html = '<div'.HTML::attributes($attributes).'>';
		
		if($enable_close)
			$html .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';
		
		$html .= $message.'</div>'; 

		return $html;
	}

	/**
	 * Create a new Success Alert.
	 *
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function success($message, $enable_close = true, $attributes = array())
	{
		return static::show(Alert::SUCCESS, $message, $enable_close, $attributes);
	}

	/**
	 * Create a new Info Alert.
	 *
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function info($message, $enable_close = true, $attributes = array())
	{
		return static::show(Alert::INFO, $message, $enable_close, $attributes);
	}

	/**
	 * Create a new Warning Alert.
	 *
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function warning($message, $enable_close = true, $attributes = array())
	{
		return static::show(Alert::WARNING, $message, $enable_close, $attributes);
	}

	/**
	 * Create a new Error Alert.
	 *
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function error($message, $enable_close = true, $attributes = array())
	{
		return static::show(Alert::ERROR, $message, $enable_close, $attributes);
	}

	/**
	 * Create a new Danger Alert.
	 *
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function danger($message, $enable_close = true, $attributes = array())
	{
		return static::show(Alert::DANGER, $message, $enable_close, $attributes);
	}
	
	/**
	 * Create a new custom Alert.
	 * This assumes you have created the appropriate css class for the alert type.
	 *
	 * @param  string     $type
	 * @param  string     $message
	 * @param  bool       $enable_close
	 * @param  array      $attributes
	 * @return string     Alert HTML
	 */
	public static function custom($type, $message, $enable_close = true, $attributes = array())
	{
		$type = 'alert-'.(string)$type;

		return static::show($type, $message, $enable_close, $attributes);
	}
}