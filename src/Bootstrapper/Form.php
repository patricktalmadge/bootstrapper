<?php
namespace Bootstrapper;

use Illuminate\Support\Facades\Facade;

/**
 * Form methods for creating Twitter Bootstrap forms.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @author     Patrick Rose - <pjr0911025@googlemail.com>
 * @author     Marvin Schröder - <marvinschroeder85@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Form extends Facade
{
  /**
   * Default - not required, left-aligned labels on top of controls
   */
  const TYPE_VERTICAL   = 'form-vertical';

  /**
   * Right-aligned labels controls are on the same line.
   * This requires the control-group container.
   * @see control_group($label, $control, $group_class = '', $help = null)
   */
  const TYPE_HORIZONTAL = 'form-horizontal';

  /**
   * Left-aligned labels and inline controls for small forms
   */
  const TYPE_INLINE     = 'form-inline';

  /**
   * Adds extra roundind to text input fields
   * PRose: .form-search removed in BS3
   */
  const TYPE_SEARCH     = "form-search";

  /**
   * Display types
   */
  const NORMAL  = '';
  const WARNING = 'has-warning';
  const ERROR   = 'has-error';
  const SUCCESS = 'has-success';

  /**
   * Redirect calls to Form facade
   */
  public static function getFacadeAccessor()
  {
    return Helpers::getContainer('form');
  }

  /**
   * Function adds the given value to the attribute of for the provided HTML.
   *
   * @param string $attr  attribute string
   * @param string $value value to add to attribute string
   * @param string $html  html to search for attribute
   *
   * @return string
   */
  protected static function add_attribute($attr, $value, $html)
  {
    $_attr = $attr.'=';

    $attr_pos =  strpos($html, $_attr);
    if ($attr_pos === false) {
      $str_pos =  strpos($html, ' ') + 1;
      $html = substr_replace($html, $_attr.'"'.$value.'" ', $str_pos,  0);
    } else {
      $start = $attr_pos + strlen($_attr) + 1;
      $end = strpos($html, '"', $start);

      $classes = substr($html, $start, $end - $start);
      if (strpos($classes, $value) === false) {
        $html = str_replace($classes, $value.' '.$classes,  $html);
      }
    }

    return $html;
  }

  /**
   * Checks call to see if we can create an input from a magic call (for you wizards).
   * large_text, xlarge_textarea, small_number, etc...
   *
   * @param string $method     Name of missing method
   * @param array  $parameters array of parameters passed to missing method
   *
   * @return mixed
   */
  protected static function magic_input($method, $parameters)
  {
    //$sizes = array('mini' , 'small', 'medium', 'large', 'xlarge', 'xxlarge', 'span1', 'span2', 'span3', 'span4', 'span5', 'span6', 'span7', 'span8', 'span9', 'span10', 'span11', 'span12');
    $types = array('input', 'text', 'password', 'uneditable', 'select', 'multiselect', 'file', 'textarea', 'date', 'number', 'url', 'tel', 'email', 'search');

    $method_array = explode('_', strtolower($method));
    $type_found = array_intersect($method_array, $types);

    if (count($type_found) > 0) {
      $function = $type_found[key($type_found)];
      $attr_index = 0;

      switch ($function) {
        case 'password':
        case 'file':
        case 'uneditable':
          // password($name, $attributes = array())
          // Set attributes array and call function
          $attr_index = 1;
          break;
        case 'input':
          // input($type, $name, $value = null, $attributes = array())
          // Set defaults and attributes array and call function
          if (!isset($parameters[2])) $parameters[2] = null;
          $attr_index = 3;
          break;
        case 'select':
        case 'multiselect':
          // select($name, $options = array(), $selected = null, $attributes = array())
          // Set defaults and attributes array and call functions
          if (!isset($parameters[1])) $parameters[1] = array();
          if (!isset($parameters[2])) $parameters[2] = null;
          $attr_index = 3;
          break;
          default:
          // text($name, $value = null, $attributes = array())
          // textarea($name, $value = null, $attributes = array())
          // Covers all the other methods
          if (!isset($parameters[1])) $parameters[1] = null;
          $attr_index = 2;
          break;
      }
        if (in_array($function, $types))
          {
          $attributes = isset($parameters[$attr_index]) ? $parameters[$attr_index] : array('class' => '');
          $attributes['class'] = isset($attributes['class']) ? $attributes['class'] . ' form-control' : 'form-control';
          $parameters[$attr_index] = $attributes;
      }
        $parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, $attr_index, 'input-', 'span');
        $method = $function;

    }

      if (method_exists('Bootstrapper\Form', $method)) {
        return call_user_func_array('static::'.$method, $parameters);
    } elseif (method_exists(static::getFacadeAccessor(), $method)) {
        return parent::__callStatic($method, $parameters);
    }else{

        try{
          //Try solving a macro
          return parent::__callStatic($method, $parameters);
      }catch(\BadMethodCallException $e){
          //Silences in case there is no macro and continues execution
      }

    }

      array_unshift($parameters, $method);

      return call_user_func_array('parent::input', $parameters);
  }

    /**
     * Open a HTML form styled for search.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function search_open($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      //.form-search not in BS3
      //$attributes = Helpers::add_class($attributes, Form::TYPE_SEARCH);

      return static::open(array_merge($attributes, array(
        'url' => $action,
        'method' => $method,
      )));
  }

    /**
     * Open a secure HTML form styled for search.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function search_open_secure($action = null, $method = 'POST', $attributes = array())
    {
      return static::search_open($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form for file upload styled for search.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function search_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes['enctype'] = 'multipart/form-data';

      return static::search_open($action, $method, $attributes, $https);
  }

    /**
     * Open a secure HTML form for file upload styled for search.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function search_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
    {
      return static::search_open_for_files($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled as an inline form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function inline_open($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes = Helpers::add_class($attributes, Form::TYPE_INLINE);

      return static::open(array_merge($attributes, array(
        'url' => $action,
        'method' => $method,
      )));
  }

    /**
     * Open a secure HTML form styled as an inline form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function inline_open_secure($action = null, $method = 'POST', $attributes = array())
    {
      return static::inline_open($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled as an inline form for files.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function inline_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes['enctype'] = 'multipart/form-data';

      return static::inline_open($action, $method, $attributes, $https);
  }

    /**
     * Open a secure HTML form styled as an inline form for files.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function inline_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
    {
      return static::inline_open_for_files($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled for a horizontal form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function horizontal_open($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes = Helpers::add_class($attributes, Form::TYPE_HORIZONTAL);

      return static::open(array_merge($attributes, array(
        'url' => $action,
        'method' => $method,
      )));
  }

    /**
     * Open a secure HTML form styled for a horizontal form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function horizontal_open_secure($action = null, $method = 'POST', $attributes = array())
    {
      return static::horizontal_open($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled for a horizontal form for files upload.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function horizontal_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes['enctype'] = 'multipart/form-data';

      return static::horizontal_open($action, $method, $attributes, $https);
  }

    /**
     * Open a secure HTML form styled for a horizontal form for files upload.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function horizontal_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
    {
      return static::horizontal_open_for_files($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled for a vertical form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function vertical_open($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      return static::open(array_merge($attributes, array(
        'url' => $action,
        'method' => $method,
      )));
  }

    /**
     * Open a secure HTML form styled for a vertical form.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function vertical_open_secure($action = null, $method = 'POST', $attributes = array())
    {
      return static::vertical_open($action, $method, $attributes, true);
  }

    /**
     * Open a HTML form styled for a vertical form for files upload.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     * @param bool   $https      make for secure
     *
     * @return string
     */
    public static function vertical_open_for_files($action = null, $method = 'POST', $attributes = array(), $https = null)
    {
      $attributes['enctype'] = 'multipart/form-data';

      return static::vertical_open($action, $method, $attributes, $https);
  }

    /**
     * Open a secure HTML form styled for a vertical form for files upload.
     *
     * @param string $action     form action
     * @param string $method     form method type
     * @param array  $attributes array of attributes for form
     *
     * @return string
     */
    public static function vertical_open_secure_for_files($action = null, $method = 'POST', $attributes = array())
    {
      return static::vertical_open_for_files($action, $method, $attributes, true);
  }

    /**
     * Create a HTML span tag with the bootstrap help-inline class.
     *
     * @param string $value      value of help text
     * @param array  $attributes attributes for help span
     *
     * @return string
     */
    public static function inline_help($value, $attributes = array())
    {
      $attributes = Helpers::add_class($attributes, 'help-inline');

      return '<span'.Helpers::getContainer('html')->attributes($attributes).'>'.$value.'</span>';
  }

    /**
     * Create a HTML p tag with the bootstrap help-block class.
     *
     * @param string $value      value of help text
     * @param array  $attributes attributes for help span
     *
     * @return string
     */
    public static function block_help($value, $attributes = array())
    {
      $attributes = Helpers::add_class($attributes, 'help-block');

      return '<p'.Helpers::getContainer('html')->attributes($attributes).'>'.$value.'</p>';
  }

    /**
     * Create a bootstrap control group.
     * $label, $control, and $help expect a fully formed HTML
     * from Laravel\Form
     *
     * @param string $label       html of the label for the group
     * @param string $control     html of the control for the group
     * @param string $group_class extra classes for the group
     * @param string $help        help value for the group
     * @param integer $label_size size to make the label column (for horizontal forms)
     *
     * @return string
     */
    public static function control_group($label, $control, $group_class = '', $help = null, $label_size = null)
    {
      $class = 'form-group';

      if ($group_class !== '') {
        $class .= ' '.$group_class;
    }

      $html = '<div class="'.$class.'">';
      $html .= isset($label_size) ? "<div class='col-sm-$label_size'>" . $label . "</div>" : $label;
      $html .= isset($label_size) ? "<div class='col-sm-" . (12 - $label_size) . "'>" . $control . "</div>" : $control;

      if (isset($help)) {
        $html .= isset($label_size) ? "<div class='col-sm-" . (12 - $label_size) . "'>" . $help . "</div>" : $help;
    }

      $html .= '</div>';

      return $html;
  }

    /**
     * Create a form label element with BS 3 class.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public static function label($name, $value = null, $options = array())
    {
      $options = Helpers::add_class($options, 'control-label');

      return parent::label($name, $value, $options);
  }

    /**
     * Create a HTML checkbox input element with a label.
     * Uses the standard checkbox function.
     *
     * @param string $name       name attribute of the checkbox
     * @param string $label      label text
     * @param string $value      value of the checkbox
     * @param bool   $checked    is checked
     * @param array  $attributes attributes for label
     *
     * @return string
     * @see Laravel\Form::checkbox()
     */
    public static function labelled_checkbox($name, $label, $value = 1, $checked = false, $attributes = array())
    {
      //Force the value of checked
      $attributes['checked'] = $checked ? "checked" : null;
      return '<label class="checkbox">'.static::checkbox($name, $value, $checked, $attributes).' '.$label.'</label>';
  }

    /**
     * Create a HTML checkbox input element with a label.
     * Uses the standard checkbox function.
     *
     * @param string $name       name attribute of the checkbox
     * @param string $label      label text
     * @param string $value      value of the checkbox
     * @param bool   $checked    is checked
     * @param array  $attributes attributes for label
     *
     * @return string
     * @see Laravel\Form::checkbox()
     */
    public static function inline_labelled_checkbox($name, $label, $value = 1, $checked = false, $attributes = array())
    {
      //Force the value of checked
      $attributes['checked'] = $checked ? "checked" : null;
      return '<label class="checkbox-inline">'.static::checkbox($name, $value, $checked, $attributes).' ' .$label.'</label>';
  }

    /**
     * Create a HTML radio input element with a label.
     * Uses the standard radio function.
     *
     * @param string $name       name attribute of the radio
     * @param string $label      label text
     * @param string $value      value of the radio
     * @param bool   $checked    is checked
     * @param array  $attributes attributes for label
     *
     * @return string
     * @see Laravel\Form::radio()
     */
    public static function labelled_radio($name, $label, $value = 1, $checked = false, $attributes = array())
    {
      return '<label class="radio">'.static::radio($name, $value, $checked, $attributes).' '.$label.'</label>';
  }

    /**
     * Create a HTML radio input element with a label.
     * Uses the standard radio function.
     *
     * @param string $name       name attribute of the radio
     * @param string $label      label text
     * @param string $value      value of the radio
     * @param bool   $checked    is checked
     * @param array  $attributes attributes for label
     *
     * @return string
     * @see Laravel\Form::radio()
     */
    public static function inline_labelled_radio($name, $label, $value = 1, $checked = false, $attributes = array())
    {
      return '<label class="radio-inline">'.static::radio($name, $value, $checked, $attributes).' '.$label.'</label>';
  }

    /**
     * Create a HTML select element with multiple select.
     *
     * @param string $name       name of the select menu
     * @param array  $options    array of options
     * @param string $selected   selected values
     * @param array  $attributes attributes for select menu
     *
     * @return string
     */
    public static function multiselect($name, $options = array(), $selected = null, $attributes = array())
    {
      $attributes['multiple'] = 'multiple';

      return static::select($name, $options, $selected, $attributes);
  }

    /**
     * Create a HTML for an uneditable control
     *
     * @param string $value      value of uneditable control
     * @param array  $attributes attributes for control
     *
     * @return string
     */
    public static function uneditable($value, $attributes = array())
    {
      $attributes = Helpers::add_class($attributes, 'uneditable-input');

      return '<span'.Helpers::getContainer('html')->attributes($attributes).'>'.Helpers::getContainer('html')->entities($value).'</span>';
  }

    /**
     * Create a file input with the Bootstrap input-file class.
     *
     * @param string $name       name of the file control
     * @param array  $attributes attributes for control
     *
     * @return string
     * @see Laravel\Form::file()
     */
    public static function file($name, $attributes = array())
    {
      $attributes = Helpers::add_class($attributes, 'input-file');

      return parent::file($name, $attributes);
  }

    /**
     * Create a text box with the search-query class.
     *
     * @param string $name       name of the textbox
     * @param string $value      value of textbox
     * @param array  $attributes attributes for control
     *
     * @return string
     * @see Laravel\Form::text()
     */
    public static function search_box($name, $value = null, $attributes = array())
    {
      $attributes = Helpers::add_class($attributes, 'search-query');

      return static::text($name, $value, $attributes);
  }

    /**
     * Create a group of form actions (buttons).
     *
     * @param mixed $buttons String or array of HTML buttons.
     *
     * @return string
     */
    public static function actions()
    {
      // Fetch arguments
      $buttons = func_get_args();
      if(sizeof($buttons) == 1) $buttons = $buttons[0];

      $html  = '<div class="form-control">';
      $html .= is_array($buttons) ? implode(' ', $buttons) : $buttons;
      $html .= '</div>';

      return $html;
  }

    /**
     * Create an input control with a prepended string.
     *
     * @param string $control control that should have a prepended value
     * @param string $value   value to prepend to control
     *
     * @return string
     */
    public static function prepend($control, $value)
    {
      return '<div class="input-group"><span class="input-group-addon">'.$value.'</span>'.$control.'</div>';
  }

    /**
     * Create an input control with an appended string.
     *
     * @param string $control control that should have an appended value
     * @param string $value   value to append to control
     *
     * @return string
     */
    public static function append($control, $value)
    {
      return '<div class="input-group">'.$control.'<span class="input-group-addon">'.$value.'</span></div>';
  }

    /**
     * Create an input control with a prepended and appended string.
     *
     * @param string $control    control between values
     * @param string $pre_value  prepended value
     * @param string $post_value appeneded value
     *
     * @return string
     */
    public static function prepend_append($control, $pre_value, $post_value)
    {
      return '<div class="input-group"><span class="input-group-addon">'.$pre_value.'</span>'.$control.'<span class="input-group-addon">'.$post_value.'</span></div>';
  }

    /**
     * Create an input control with a series of appended buttons.
     *
     * @param string $control control to append buttons to
     * @param mixed  $buttons html or array of html buttons
     *
     * @return string
     */
    public static function append_buttons($control, $buttons)
    {
      $value = is_array($buttons) ? implode('</span><span class="input-group-btn">', $buttons) : $buttons;
      $value = '<span class="input-group-btn">'.$value.'</span>';

      return '<div class="input-group">'.$control.$value.'</div>';
  }



    /**
     * Create an input control with a series of appended buttons.
     *
     * @param string $control control to append buttons to
     * @param mixed  $buttons html or array of html buttons
     *
     * @return string
     */
    public static function prepend_buttons($control, $buttons)
    {
      $value = is_array($buttons) ? implode('</span><span class="input-group-btn">', $buttons) : $buttons;
      $value = '<span class="input-group-btn">'.$value.'</span>';

      return '<div class="input-group">'.$value.$control.'</div>';
  }

    /**
     * Create a HTML submit input element.
     * Overriding the default input submit button from Laravel\Form
     *
     * @param string $value       text value of button
     * @param array  $attributes  array of attributes for button
     * @param bool   $hasDropdown button has dropdown
     *
     * @return string
     */
    public static function submit($value = null, $attributes = array(), $hasDropdown = false)
    {
      return Button::submit($value, $attributes, $hasDropdown);
  }

    /**
     * Create a HTML reset input element.
     * Overriding the default input reset button from Laravel\Form
     *
     * @param string $value       text value of button
     * @param array  $attributes  array of attributes for button
     * @param bool   $hasDropdown button has dropdown
     *
     * @return string
     */
    public static function reset($value = null, $attributes = array(), $hasDropdown = false)
    {
      return Button::reset($value, $attributes, $hasDropdown);
  }

    /**
     * Create a HTML button element.
     * Overriding the default button to add the correct class from Laravel\Form
     *
     * @param string $value       text value of button
     * @param array  $attributes  array of attributes for button
     * @param bool   $hasDropdown button has dropdown
     *
     * @return string
     */
    public static function button($value = null, $attributes = array(), $hasDropdown = false)
    {
      return Button::normal($value, $attributes, $hasDropdown);
  }

    /**
     * Dynamically handle calls to custom calls.
     *
     * @param string $method     Name of missing method
     * @param array  $parameters array of parameters passed to missing method
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
      return static::magic_input($method, $parameters);
  }
}
