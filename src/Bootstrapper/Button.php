<?php
namespace Bootstrapper;

use \HTML;

/**
 * Button methods for creating Twitter Bootstrap buttons.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Button
{
    /**
     * The current instance of Button being used
     * @var Button
     */
    private static $instance = null;

    /**
     * The current button in memory
     * @var array
     */
    private $currentButton = array();

    /**
     * Stores the current button for future output
     *
     * @param string  $type        A button type
     * @param string  $value       Its text value
     * @param array   $attributes  An array of attributes
     * @param boolean $hasDropdown Whether the button has a dropdown
     *
     * @return object Button instance
     */
    private static function storeButton($type, $value, $attributes, $hasDropdown)
    {
        // If we don't have an instance stored, create a new one
        $currentInstance = self::$instance ?: new Button;

        // Define new button
        $currentInstance->currentButton = array(
            'type'        => $type,
            'value'       => $value,
            'attributes'  => $attributes,
            'hasDropdown' => $hasDropdown,
        );

        return $currentInstance;
    }

    /**
     * Create a HTML submit input element.
     * Overriding the default input submit button from Laravel\Form
     *
     * @param string $value       Text value of button
     * @param array  $attributes  array of attributes
     * @param bool   $hasDropdown Whether the button has a dropdown
     *
     * @return object Button instance
     */
    public static function submit($value, $attributes = array(), $hasDropdown = false)
    {
        $attributes['type'] = 'submit';

        return static::storeButton('normal', $value, $attributes, $hasDropdown);
    }

    /**
     * Create a HTML reset input element.
     * Overriding the default input reset button from Laravel\Form
     *
     * @param string $value       Text value of button
     * @param array  $attributes  array of attributes
     * @param bool   $hasDropdown Whether the button has a dropdown
     *
     * @return object Button instance
     */
    public static function reset($value, $attributes = array(), $hasDropdown = false)
    {
        $attributes['type'] = 'reset';

        return static::storeButton('normal', $value, $attributes, $hasDropdown);
    }

    /**
     * Create a HTML button element.
     * Overriding the default button to add the correct class from Laravel\Form
     *
     * @param string $value       Text value of button
     * @param array  $attributes  array of attributes
     * @param bool   $hasDropdown Whether the button has a dropdown
     *
     * @return object Button instance
     */
    public static function normal($value, $attributes = array(), $hasDropdown = false)
    {
        return static::storeButton('normal', $value, $attributes, $hasDropdown);
    }

    /**
     * Create a HTML anchor tag styled like a button element.
     *
     * @param string $url         Url of the link
     * @param string $value       Text value of button
     * @param array  $attributes  array of attributes
     * @param bool   $hasDropdown Whether the button has a dropdown
     *
     * @return object Button instance
     */
    public static function link($url, $value, $attributes = array(), $hasDropdown = false)
    {
        $attributes['href'] = \URL::to($url);

        return static::storeButton('link', $value, $attributes, $hasDropdown);
    }

    /**
     * Adds an icon to the next button
     *
     * @param string  $icon        The name of the icon to call
     * @param array   $attributes  Attributes to pass to the generated icon
     * @param boolean $prependIcon Whether we should prepend the icon, or append it
     *
     * @return object Button instance
     */
    public function with_icon($icon, $attributes = array(), $prependIcon = true)
    {
        // Call Icon to create the icon
        $icon = Icon::make($icon, $attributes);

        // If there was no text, just use the icon, else put a space between
        $value = $this->currentButton['value'];
        if(empty($value)) $value = $icon;
        else {
            $value = $prependIcon
            ? $icon.  ' ' .$value
            : $value. ' ' .$icon;
        }

        // Store modified value
        $this->currentButton['value'] = $value;

        return $this;
    }

    /**
     * Alias for with_icon
     *
     * @param string $icon       The name of the icon to call
     * @param array  $attributes Attributes to pass to the generated icon
     *
     * @return object Button instance
     */
    public function prepend_with_icon($icon, $attributes = array())
    {
        return $this->with_icon($icon, $attributes);
    }

    /**
     * Alias for with_icon with $prependIcon to false
     *
     * @param string $icon       The name of the icon to call
     * @param array  $attributes Attributes to pass to the generated icon
     *
     * @return object Button instance
     */
    public function append_with_icon($icon, $attributes = array())
    {
        return $this->with_icon($icon, $attributes, false);
    }

    /**
     * Add class to deemphasize the button to look more like an anchor tag
     *
     * @return object Button instance
     */
    public function deemphasize()
    {
        // Add class to attributes array
        $this->currentButton['attributes'] = Helpers::add_class($this->currentButton['attributes'], 'btn-link');

        return $this;
    }

    /**
     * Add class to make button block
     *
     * @return object Button instance
     */
    public function block()
    {
        // Add class to attributes array
        $this->currentButton['attributes'] = Helpers::add_class($this->currentButton['attributes'], 'btn-block');

        return $this;
    }

    /**
     * Checks call to see if we can create a button from a magic call (for you wizards).
     * success_button, mini_primary_button, large_warning_submit, danger_reset, etc...
     *
     * @param string $method     Name of missing method
     * @param array  $parameters array of parameters passed to missing method
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $method_array = explode('_', strtolower($method));

        $btn_types  = array('normal', 'submit', 'reset', 'link');
        $type_found = array_intersect($method_array, $btn_types);
        if(!$type_found) $type_found = (array) 'normal';

        if (count($type_found) > 0) {
            $function = $type_found[key($type_found)];

            // Set default attributes index
            $attr_index = $function != 'link' ? 1 : 2;

            $parameters = Helpers::set_multi_class_attributes($function, $method_array, $parameters, $attr_index, 'btn-', 'disabled');
            if(in_array('disabled', $method_array)) $parameters[$attr_index]['disabled'] = 'disabled';

            return call_user_func_array('static::'.$function, $parameters);
        }
    }

    /**
     * Prints the current button in memory
     *
     * @return string A button
     */
    public function __toString()
    {
        // Gather variables
        extract($this->currentButton);

        // Add btn to classes and fallback type
        if(!isset($attributes['type'])) $attributes['type'] = 'button';
        $attributes = Helpers::add_class($attributes, 'btn');

        // Modify output if we have a dropdown
        $caret = null;
        if ($hasDropdown) {
            $attributes = Helpers::add_class($attributes, 'dropdown-toggle');
            $caret = ' <span class="caret"></span>';
            $attributes['data-toggle'] = 'dropdown';
        }

        // Write output according to tag
        $tag = 'button';
        if ($type === 'link') {
            $tag = 'a';
            unset($attributes['type']);
        }

        return '<'.$tag.HTML::attributes($attributes).'>'.(string) $value.$caret.'</'.$tag.'>';
    }
}
