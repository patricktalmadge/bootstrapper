<?php
namespace Bootstrapper;

use \HTML;

/**
 * DropdownButton for creating Twitter Bootstrap style Dropdown Buttons.
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
class DropdownButton
{
    /**
     * The current dropdown instance
     * @var DropdownButton
     */
    protected static $dropdown = null;

    /**
     * The main button's class
     * @var string
     */
    protected $type = null;

    /**
     * The main button's label
     * @var string
     */
    protected $label = null;

    /**
     * The dropdown's links
     * @var array
     */
    protected $links = array();

    /**
     * The dropdown's attributes
     * @var array
     */
    protected $attributes = array();

    /**
     * Whether the dropdown should align right
     * @var boolean
     */
    protected $pullRight = false;

    /**
     * Whether button should be a split button or not
     * @var boolean
     */
    protected $split = false;

    /**
     * Whether the dropdown's links should come up or down
     * @var boolean
     */
    protected $dropup = false;

    /**
     * Whether links should be automatically routed or not
     * @var boolean
     */
    protected $autoroute = true;

    /**
     * Checks call to see if we can create a button from a magic call (for you wizards).
     * normal, mini_primary, large_warning, danger, etc...
     *
     * @param string $method     Name of missing method
     * @param array  $parameters array of parameters passed to missing method
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $method_array = explode('_', strtolower($method));

        // Get the dropdown's button text
        $label = array_get($parameters, 0, null);

        // Get the dropdown's links
        $links = array_get($parameters, 1, array());
        if(!is_array($links)) throw new \InvalidArgumentException('The dropdown\'s links should be an array');

        // Get the dropdown's attributes
        $attributes = array_get($parameters, 2, array());
        if(!is_array($attributes)) throw new \InvalidArgumentException('Attributes should be an array');

        // Filter the classes given and concatenate them
        $type = '';
        foreach ($method_array as $class) {
            if ($class != 'normal') $type .= ' btn-'.$class;
        }

        // Create the new dropdown
        static::$dropdown = new static($label, $links, $attributes, $type);

        return static::$dropdown;
    }

    /**
     * Creates a new button dropdown
     *
     * @param string $label      Label Text
     * @param array  $links      dropdown links
     * @param array  $attributes Attributes to apply the dropdown itself
     * @param string $type       Type of dropdown
     */
    public function __construct($label, $links, $attributes, $type = null)
    {
        $this->label = $label;

        $this->links = $links;

        $this->attributes = $attributes;

        $this->type .= $type;
    }

    /**
     * Dynamically set an attribute
     *
     * @param string $attribute Attributes to apply the dropdown itself
     * @param string $value     Value of dropdown
     *
     * @return object dropdownbutton instance
     */
    public function __call($attribute, $value)
    {
        // Replace underscores
        $attribute = str_replace('_', '-', $attribute);

        // Get value and set it
        $value = array_get($value, 0, 'true');
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Outputs the current Dropdown in instance
     *
     * @return string A Dropdown menu
     */
    public function __toString()
    {
        // Base class
        $this->attributes = Helpers::add_class($this->attributes, 'btn-group');

        // Pull right
        $listAttributes = $this->pullRight
            ? array('class' => 'pull-right')
            : array();

        // Dropup
        if ($this->dropup) $this->attributes['class'] .= ' dropup';

        $html = '<div'.HTML::attributes($this->attributes).'>';

            //If split is false make this button dropdown
            $html .= Form::button($this->label, array('class' => $this->type), !$this->split);

            //Add split button if needed
            if ($this->split) {
                $html .= Form::button('', array('class' => $this->type), true);
            }

            $html .= Navigation::dropdown($this->links, $listAttributes, $this->autoroute);
        $html .= '</div>';

        return $html;
    }

    // Public methods ---------------------------------------------- /

    /**
     * Pull the dropdown's links to the right
     *
     * @param boolean $pullRight Pull menu to the right
     *
     * @return object dropdownbutton instance
     */
    public function pull_right($pullRight = true)
    {
        $this->pullRight = $pullRight;

        return $this;
    }

    /**
     * Drop the menu up or down
     *
     * @param boolean $dropup Make menu go up
     *
     * @return object dropdownbutton instance
     */
    public function dropup($dropup = true)
    {
        $this->dropup = $dropup;

        return $this;
    }

    /**
     * Make button a split dropdown button
     *
     * @param boolean $split Make split button
     *
     * @return object dropdownbutton instance
     */
    public function split($split = true)
    {
        $this->split = $split;

        return $this;
    }

    /**
     * Auto route links or not
     *
     * @param boolean $autoroute Should auto route links
     *
     * @return object dropdownbutton instance
     */
    public function autoroute($autoroute = true)
    {
        $this->autoroute = $autoroute;

        return $this;
    }
}
