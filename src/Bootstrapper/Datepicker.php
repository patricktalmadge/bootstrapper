<?php
namespace Bootstrapper;

use \HTML;

/*  USAGE
{{Form::control_group(Form::label('birthDate', 'Birth Date'), Form::append(Bootstrapper\Datepicker::create('birthDate')->get_as_input(), '<i class="icon-calendar"></i>'))}}
{{Form::control_group(Form::label('birthDate', 'Birth Date'), Form::append(Bootstrapper\Datepicker::create('birthDate')->with_language('it')->with_options("startView:2,other:1")->get_as_input(), '<i class="icon-calendar"></i>'))}}

{{Bootstrapper\Datepicker::create('birthDate2')->get_as_group('Date as group', 'birthDateValue2')}}

{{Form::control_group(Form::label('birthDate3', 'Birth Date'), Form::append(Form::text('birthDate3'), Bootstrapper\Datepicker::create('birthDateIcon')->get_as_icon()))}}
*/

/**
 * Datepicker for creating Twitter Bootstrap Datepicker.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Pasquale Vazzana - <pasqualevazzana@gmail.com>
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Datepicker
{
    const LOCALES_PATH = '/bundles/bootstrapper/js/locales/';

    /**
     * @var string
     */
    public $name = 'myDatepicker';

    /**
     * @var string
     */
    public $icon = 'icon-calendar';
    //private $icon = 'icon-th';

    /**
     * @var array
     */
    private $options = array();

    /**
     * @var string
     */
    private $language = null;

     /**
     * @var string
     */
    //private $data_date = null;
    
    /**
     * @var string
     */
    //private $data_date_format = '';
    
    /**
     * The current Datepicker's attributes
     *
     * @var array
     */
    private $attributes  = array();

    /**
     * Whether the current Datepicker should use the close button
     *
     * @var boolean
     */
    public $has_icon   = true;

    /**
     * Create a new Datepicker instance.
     *
     * @param string $name       The name of Datepicker to create
     * @param array $attributes An array of attributes for the current Datepicker
     *
     * @return Datepicker
     */
    public static function create($name = null, $attributes = null)
    {
        // Fetch current instance
        $instance = new Datepicker;
        //$instance->data_date = date("m-d-Y");;
        //$instance->data_date_format = "mm-dd-yyyy";
        $defaultAttributes['class'] = 'date input-append';
        $defaultAttributes['data-date'] = date("m-d-Y");
        $defaultAttributes['data-date-format'] = "mm-dd-yyyy";

        if (!is_null($name) && is_string($name)) {
            $instance->name = $name;
        }

        if (!is_null($attributes)) {
            if (!is_array($attributes)) $attributes = array();
            $instance->attributes = array_merge($defaultAttributes, $attributes);
        }
        else {
            $instance->attributes = $defaultAttributes;
        }

        return $instance;
    }

    /**
     * Set the date for the current Datepicker Header
     *
     * @param string $date      the initial Date value
     * @return Datepicker
     */
    public function with_date($date)
    {
        if (is_string($date)) 
            //$this->data_date = $date;
            $defaultAttributes['data-date'] = $date;

        return $this;
    }

    /**
     * set the date format for the current Datepicker Header
     *
     * @param string $date      the Date Format
     * @return Datepicker
     */
    public function with_format($date)
    {
        if (is_string($date)) 
            //$this->data_date_format = $date;
            $defaultAttributes['data-date-format'] = $date;

        return $this;
    }

    /**
     * Add options to the current Datepicker javascript function
     *
     * @param string $option      the options for .datapicker({})
     * @return Datepicker
     */
    public function with_options($option = null)
    {
        if (is_string($option) && !is_null($option))
            $this->options[] = $option;

        return $this;
    }

    /**
     * Set the language for the current Datepicker javascript function
     *
     * @param string $option      the options for .datapicker({})
     * @return Datepicker
     */
    public function with_language($language = null)
    {
        if (is_string($language) && !is_null($language)) {
            $this->options[] = "language:'$language'";
            $this->language = $language;
        }

        return $this;
    }

    /**
     * Writes the current Datepicker as a Input
     *
     * @return string
     */
    public function get_as_input()
    {
        $attributes = $this->attributes;
        $date=(array_key_exists('data-date', $attributes)) ? $attributes['data-date'] : '';
        $html = '<input name="'.$this->name.'"'.$this->create_attributes().' type="text" value="'.$date.'">';
        return $html;
    }

    /**
     * Writes the current Datepicker as a Div
     *
     * @param string $input_name     the default name will be taken by the div so you can assign one to the input
     * @return string
     */
    public function get_as_div($input_name = '')
    {
        // Open Datepicker containers
        $html  = '<div '.$this->create_attributes().'>';

        $attributes = $this->attributes;
        $date=(array_key_exists('data-date', $attributes)) ? $attributes['data-date'] : '';
        $html .= '<input id="'.$input_name.'" name="'.$input_name.'" type="text" value="'.$date.'">';

        if ($this->has_icon) {
            $html .= '<span class="add-on"><i class="'.$this->icon.'"></i></span>';
        }

        // Close Datepicker containers
        $html .= '</div>';

        return $html;
    }

    /**
     * Writes the current Datepicker as an Icon
     *
     * @return string
     */
    public function get_as_icon()
    {
        $html = '<i '.$this->create_attributes('class="'.$this->icon.' date"').'></i>';
        return $html;
    }

    /**
     * Writes the current Datepicker as a Control Group with one Input and one Icon
     *
     * @param string $label         the Label
     * @param string $input_name    the default name will be taken by the div so you can assign one to the input
     * @return string
     */
    public function get_as_group($label='Label', $input_id='')
    {
        // Open Group containers
        $html  = '<div class="control-group">';
        $html  .= '<label for="'.$input_id.'" class="control-label">'.$label.'</label>';
        $html  .= '<div class="controls">';

        // Open Datepicker containers
        $html  .= $this->get_as_div($input_id);

        // Close Datepicker containers
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Writes the current Datepicker
     *
     * @return string A Bootstrap Datepicker
     */
    public function __toString()
    {
        return $this->get_as_div();
    }

    /**
     * Create attributes id, data-date, data-date-format
     *
     * @param string $override_attributes     In case you want to override the attributes
     * @return string                   A button to use as launcher
     */
    public function get_attributes($override_attributes = null)
    {
        $attributes = $this->attributes;
        if (!is_null($override_attributes) && is_array($override_attributes))
            $attributes = array_merge($this->attributes, $override_attributes);

        $this->produce_javascript();

        return $attributes;
    }

    /**
     * Create attributes id, data-date, data-date-format
     *
     * @param array $override_attributes     In case you want to override the attributes
     * @return string                   The html attributes
     */
    private function create_attributes($override_attributes = null)
    {
        $attributes = $this->attributes;
        if (!is_null($override_attributes) && is_array($override_attributes))
            $attributes = array_merge($this->attributes, $override_attributes);

        $this->produce_javascript();

        $attributes = HTML::attributes($attributes);
        $elements = ' %s id="%s" ';
        return sprintf($elements, $attributes, $this->name);
    }

    /**
     * Prepare the Javascripter::Injector to write the js code
     *
     */
    private function produce_javascript()
    {
        $opt = '{'.implode(',', $this->options).'}';
        if (!is_null($this->language) && $this->language != 'en' ) {
            $lang_file = Datepicker::LOCALES_PATH . 'bootstrap-datepicker.'.$this->language.'.js';
            Javascripter::add_js_script($lang_file);
        }
        Javascripter::add_js_snippet(sprintf('$("#%s").datepicker(%s);', $this->name, $opt));
    }
}
