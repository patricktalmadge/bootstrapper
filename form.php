<?php namespace Bootstrapper;

use \HTML;

/**
 * Form methods for creating Twitter Bootstrap forms.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Form extends \Laravel\Form {

	/**
	 * Default - not required, left-aligned labels on top of controls
	 */
	const TYPE_VERTICAL   = 'form-vertical';

	/**
	 * Right-aligned labels controls are on the same line.
	 * This requires the control-group container.
	 *@see control_group($label, $control, $group_class = '', $help = null)
	 */
	const TYPE_HORIZONTAL = 'form-horizontal';

	/**
	 * Left-aligned labels and inline controls for small forms
	 */
	const TYPE_INLINE     = 'form-inline';

	/**
	 * Adds extra roundind to text input fields
	 */
	const TYPE_SEARCH     = 'form-search';

	/**
	 * Function adds the given value to the attribute of for the provided HTML.
	 *
	 * @param  string  $attr
	 * @param  string  $value
	 * @param  string  $html
	 * @return string
	*/
	protected static function add_attribute($attr, $value, $html)
	{
		$_attr = $attr.'=';

		$attr_pos =  strpos($html, $_attr);
		if($attr_pos === false)
		{
			$str_pos =  strpos($html, ' ') + 1;
			$html = substr_replace($html, $_attr.'"'.$value.'" ', $str_pos,  0);
		}
		else
		{
			$start = $attr_pos + strlen($_attr) + 1;
			$end = strpos($html, '"', $start);

			$classes = substr($html, $start, $end - $start);
			if(strpos($classes, $value) === false)
			{
				$html = str_replace($classes, $value.' '.$classes,  $html);
			}
		}
		return $html;
	}


	/**
	 * Checks call to see if we can create an input from a magic call (for you wizards).
	 * large_text, xlarge_textarea, small_number, etc...
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	*/
	protected static function magic_input($method, $parameters)
	{
		//.input-
		//$sizes = array('mini' , 'small', 'medium', 'large', 'xlarge', 'xxlarge');
		$types = array('input', 'text', 'password', 'uneditable', 'select', 'multiselect', 'file', 'textarea', 'date', 'number', 'url', 'telephone', 'email', 'search');
	
		$method_array = explode('_', strtolower($method));
		$type_found = array_intersect($method_array, $types);

		if(count($type_found) > 0)
		{
			$function = $type_found[key($type_found)];
			$attr_index = 0;

			switch ($function)
			{
				case 'password':
				case 'file':
				case 'uneditable':
					//password($name, $attributes = array())
					//Set attributes array and call function
					$attr_index = 1;
					break;
				case 'input':
					//input($type, $name, $value = null, $attributes = array())	
					//Set defaults and attributes array and call function
					if(!isset($parameters[2])){ $parameters[2] = null;}
					$attr_index = 3;
					break;
				case 'select':
				case 'multiselect':
				 	//select($name, $options = array(), $selected = null, $attributes = array())
					//Set defaults and attributes array and call function
					if(!isset($parameters[1])){ $parameters[1] = array();}
					if(!isset($parameters[2])){ $parameters[2] = null;}
					$attr_index = 3;
					break;
				case 'textarea':
					//textarea($name, $value = '', $attributes = array())
					//Covers all the other methods
					if(!isset($parameters[1])){ $parameters[1] = '';}
					$attr_index = 2;
					break;
				default:
					//text($name, $value = null, $attributes = array())
					//Covers all the other methods
					if(!isset($parameters[1])){ $parameters[1] = null;}
					$attr_index = 2;
					break;
			}
			$parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, $attr_index, 'input-', 'span');
			return call_user_func_array('static::'.$function, $parameters);
		}
	}

	public static function search_open($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes = Helpers::add_class($attributes, Form::TYPE_SEARCH);
		return static::open($action, $method, $attributes, $https);
	}

	public static function search_open_secure($action = null, $method = 'POST', $attributes = array())
	{
		return static::search_open($action, $method, $attributes, true);
	}

	public static function search_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes['enctype'] = 'multipart/form-data';

		return static::search_open($action, $method, $attributes, $https);
	}

	public static function search_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
	{
		return static::search_open_for_files($action, $method, $attributes, true);
	}




	public static function inline_open($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes = Helpers::add_class($attributes, Form::TYPE_INLINE);
		return static::open($action, $method, $attributes, $https);
	}

	public static function inline_open_secure($action = null, $method = 'POST', $attributes = array())
	{
		return static::inline_open($action, $method, $attributes, true);
	}

	public static function inline_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes['enctype'] = 'multipart/form-data';

		return static::inline_open($action, $method, $attributes, $https);
	}

	public static function inline_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
	{
		return static::inline_open_for_files($action, $method, $attributes, true);
	}





	public static function horizontal_open($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes = Helpers::add_class($attributes, Form::TYPE_HORIZONTAL);
		return static::open($action, $method, $attributes, $https);
	}

	public static function horizontal_open_secure($action = null, $method = 'POST', $attributes = array())
	{
		return static::horizontal_open($action, $method, $attributes, true);
	}

	public static function horizontal_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes['enctype'] = 'multipart/form-data';

		return static::horizontal_open($action, $method, $attributes, $https);
	}

	public static function horizontal_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
	{
		return static::horizontal_open_for_files($action, $method, $attributes, true);
	}





	public static function vertical_open($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		return static::open($action, $method, $attributes, $https);
	}

	public static function vertical_open_secure($action = null, $method = 'POST', $attributes = array())
	{
		return static::vertical_open($action, $method, $attributes, true);
	}

	public static function vertical_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
	{
		$attributes['enctype'] = 'multipart/form-data';

		return static::vertical_open($action, $method, $attributes, $https);
	}

	public static function vertical_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
	{
		return static::vertical_open_for_files($action, $method, $attributes, true);
	}


	/**
	 * Create a HTML span tag with the bootstrap help-inline class.
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @return string
	 */
	public static function inline_help($value, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'help-inline');
		return '<span '.HTML::attributes($attributes).'>'.$value.'</span>';
	}

	/**
	 * Create a HTML p tag with the bootstrap help-block class.
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @return string
	 */
	public static function block_help($value, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'help-block');
		return '<p '.HTML::attributes($attributes).'>'.$value.'</p>';
	}


	/**
	 * Create a bootstrap control group.
	 * $label, $control, and $help expect a fully formed HTML 
	 * from Laravel\Form 
	 *
	 * @param  string  $label
	 * @param  string  $control
	 * @param  string  $group_class
	 * @param  string  $help
	 * @return string
	 */
	public static function control_group($label, $control, $group_class = '', $help = null)
	{
		$html = '<div class="control-group '. $group_class .'">'; 
		$html .= static::add_attribute('class', 'control-label', $label);
     	$html .= '<div class="controls">';

     	$html .= $control;

     	if(isset($help))
     	{
     		$html .= $help;
     	}

     	$html .= '</div></div>';
     	return $html;
	}

	/**
	 * Create a HTML checkbox input element with a label.
	 * Uses the standard checkbox function.
	 *
	 * @see Laravel\Form::checkbox()
	 * @param  string  $label
	 * @param  string  $name
	 * @param  string  $value
	 * @param  bool    $checked
	 * @param  array   $attributes
	 * @return string
	 */
	public static function labelled_checkbox($name, $label, $value = 1, $checked = false, $attributes = array())
	{
		return '<label class="checkbox">'.static::checkbox($name, $value, $checked, $attributes).' '.$label.'</label>';
	}

	/**
	 * Create a HTML checkbox input element with a label.
	 * Uses the standard checkbox function.
	 *
	 * @see Laravel\Form::checkbox()
	 * @param  string  $label
	 * @param  string  $name
	 * @param  string  $value
	 * @param  bool    $checked
	 * @param  array   $attributes
	 * @return string
	 */
	public static function inline_labelled_checkbox($name, $label, $value = 1, $checked = false, $attributes = array())
	{
		return '<label class="checkbox inline">'.static::checkbox($name, $value, $checked, $attributes).' '.$label.'</label>';
	}


	/**
	 * Create a HTML radio input element with a label.
	 * Uses the standard radio function.
	 *
	 * @see Laravel\Form::radio()
	 * @param  string  $label
	 * @param  string  $name
	 * @param  string  $value
	 * @param  bool    $checked
	 * @param  array   $attributes
	 * @return string
	 */
	public static function labelled_radio($name, $label, $value = 1, $checked = false, $attributes = array())
	{
		return '<label class="radio">'.static::radio($name, $value, $checked, $attributes).' '.$label.'</label>';
	}

	/**
	 * Create a HTML radio input element with a label.
	 * Uses the standard radio function.
	 *
	 * @see Laravel\Form::radio()
	 * @param  string  $label
	 * @param  string  $name
	 * @param  string  $value
	 * @param  bool    $checked
	 * @param  array   $attributes
	 * @return string
	 */
	public static function inline_labelled_radio($name, $label, $value = 1, $checked = false, $attributes = array())
	{
		return '<label class="radio inline">'.static::radio($name, $value, $checked, $attributes).' '.$label.'</label>';
	}

	/**
	 * Create a HTML select element with multiple select.
	 *
	 * @param  string  $name
	 * @param  array   $options
	 * @param  string  $selected
	 * @param  array   $attributes
	 * @return string
	 */	
	public static function multiselect($name, $options = array(), $selected = null, $attributes = array())
	{
		$attributes['multiple'] = 'multiple';
		return static::select($name, $options, $selected, $attributes);
	}


	public static function uneditable($value, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'uneditable-input');
		return '<span'.HTML::attributes($attributes).'>'.HTML::entities($value).'</span>';
	}

	/**
	 * Create a file input with the Bootstrap input-file class.
	 *
	 * @see Laravel\Form::file()
	 * @param  string  $name
	 * @param  array   $attributes
	 * @return string
	 */
	public static function file($name, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'input-file');
		return parent::file($name, $attributes);	
	}

	/**
	 * Create a text box with the search-query class.
	 *
	 * @see Laravel\Form::text()
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $attributes
	 * @return string
	 */
	public static function search_box($name, $value = null, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'search-query');
		return static::text($name, $value, $attributes);
	}

	/**
	 * Create a group of form actions (buttons).
	 *
	 * @param  mixed  $buttons  String or array of HTML buttons.
	 * @return string
	 */
	public static function actions($buttons)
	{
		$html  = '<div class="form-actions">';
		$html .= is_array($buttons) ? implode(' ', $buttons) : $buttons;
		$html .= '</div>';

		return $html;
	}

	/**
	 * Create an input control with a prepended string.
	 *
	 * @param  string  $control
	 * @param  string  $value
	 * @return string
	 */
	public static function prepend($control, $value)
	{
		return '<div class="input-prepend"><span class="add-on">'.$value.'</span>'.$control.'</div>';
	}

	/**
	 * Create an input control with an appended string.
	 *
	 * @param  string  $control
	 * @param  string  $value
	 * @return string
	 */
	public static function append($control, $value)
	{
		return '<div class="input-append">'.$control.'<span class="add-on">'.$value.'</span></div>';
	}

	/**
	 * Create an input control with a prepended and appended string.
	 *
	 * @param  string  $control
	 * @param  string  $pre_value
	 * @param  string  $post_value
	 * @return string
	 */
	public static function prepend_append($control, $pre_value, $post_value)
	{
		return '<div class="input-prepend input-append"><span class="add-on">'.$pre_value.'</span>'.$control.'<span class="add-on">'.$post_value.'</span></div>';
	}

	/**
	 * Create an input control with a series of appended buttons.
	 *
	 * @param  string $control
	 * @param  mixed  $buttons
	 * @return string
	 */
	public static function append_buttons($control, $buttons)
	{
		$value = is_array($buttons) ? implode('', $buttons) : $buttons;
		return '<div class="input-append">'.$control.$value.'</div>';
	}

	/**
	 * Create a HTML submit input element. 
	 * Overriding the default input submit button from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function submit($value, $attributes = array(), $hasDropdown = false)
	{
		return Buttons::submit($value, $attributes, $hasDropdown);
	}

	/**
	 * Create a HTML reset input element.
	 * Overriding the default input reset button from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function reset($value, $attributes = array(), $hasDropdown = false)
	{
		return Buttons::reset($value, $attributes, $hasDropdown);
	}

	/**
	 * Create a HTML button element.
	 * Overriding the default button to add the correct class from Laravel\Form
	 *
	 * @param  string  $value
	 * @param  array   $attributes
	 * @param  bool    $hasDropdown
	 * @return string
	 */
	public static function button($value, $attributes = array(), $hasDropdown = false)
	{
		return Buttons::normal($value, $attributes, $hasDropdown);
	}


	/**
	 * Dynamically handle calls to custom calls.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public static function __callStatic($method, $parameters)
	{
		$in = static::magic_input($method, $parameters);
		if($in !== null){
			return $in;
		}

	    return parent::__callStatic($method, $parameters);
	}
}