<?php
namespace Bootstrapper;

/**
 * Navbar for creating Twitter Bootstrap style Navbar.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @author     Maxime Fabre - <ehtnam6@gmail.com>
 * @author     Marvin Schröder - <marvinschroeder85@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */
class Navbar
{
    /**
     * The current Navbar's attributes
     *
     * @var array
     */
    protected $attributes  = array();

    /**
     * Whether the current Navbar should use automatic routing
     *
     * @var boolean
     */
    protected $autoroute   = true;

    /**
     * Contains the current Navbar's brand (if there is one)
     *
     * @var array
     */
    protected $brand       = array();

    /**
     * Whether the current Navbar should be collapsible or not
     *
     * @var boolean
     */
    protected $collapsible = false;

    /**
     * All menus or elements of the current Navbar
     *
     * @var array
     */
    protected $menus       = array();

    /**
     * The current Navbar's type
     *
     * @var constant
     */
    protected $type        = Navbar::DEFAULT_TYPE;

    /**
     * The current Navbar's style
     *
     * @var constant
     */
    protected $style        = Navbar::DEFAULT_BAR;

    /**
     * The Navbar styles
     * @var constant
     */
    const DEFAULT_BAR = 'navbar-default';
    const INVERSE_BAR = 'navbar-inverse';

    /**
     * The Navbar types
     * @var constant
     */
    const DEFAULT_TYPE     = null;
    const FIX_TOP     = 'navbar-fixed-top';
    const FIX_BOTTOM  = 'navbar-fixed-bottom';
    const STATIC_TOP  = 'navbar-static-top';

    /**
     * Create a new Navbar instance.
     *
     * @param array $attributes An array of attributes for the current navbar
     * @param const $type       The type of Navbar to create
     *
     * @return Navbar
     */
    public static function create($attributes = array(), $type = Navbar::DEFAULT_TYPE)
    {
        if(!isset($attributes['class']) or (isset($attributes['class']) and !stristr($attributes['class'], Navbar::INVERSE_BAR))){
            $attributes = Helpers::add_class($attributes, Navbar::DEFAULT_BAR);
        }
        // Fetch current instance
        $instance = new Navbar;

        // Save given parameters
        $instance->attributes = $attributes;
        $instance->type       = $type;

        return $instance;
    }

    /**
     * Set the autoroute to true or false
     *
     * @param boolean $autoroute The new autoroute value
     *
     * @return Navbar
     */
    public function autoroute($autoroute)
    {
        $this->autoroute = $autoroute;

        return $this;
    }

    /**
     * Add menus or strings to the current Navbar
     *
     * @param mixed $menus      An array of items or a string
     * @param array $attributes An array of attributes to use
     *
     * @return Navbar
     */
    public function with_menus($menus, $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'navbar-nav');
        $this->menus[] = is_string($menus)
            ? $menus
            : array('attributes' => $attributes, 'items' => $menus);

        return $this;
    }

    /**
     * Add a brand to the current Navbar
     *
     * @param string $brand     The brand name
     * @param string $brand_url The brand URL
     *
     * @return Navbar
     */
    public function with_brand($brand, $brand_url, $escape_string = true)
    {
        $this->brand = array(
            'name' => $brand,
            'url'  => $brand_url,
            'escape' => $escape_string
        );

        return $this;
    }

    /**
     * Activates collapsible on the current Navbar
     *
     * @return Navbar
     */
    public function collapsible()
    {
        $this->collapsible = true;

        return $this;
    }

    /**
     * Prints out the current Navbar in case it doesn't do it automatically
     *
     * @return string A Navbar
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Writes the current Navbar
     *
     * @return string A Bootstrap navbar
     */
    public function render()
    {
        $type = (!empty($this->type)) ? ' '.$this->type : '';
        $attributes = Helpers::add_class($this->attributes, 'navbar'.$type);

        // Open navbar containers
        $html  = '<nav'.Helpers::getContainer('html')->attributes($attributes).' role="navigation">';
        $html .= '<div class="container">';
		
		// --- Header ---
        $html .= '<div class="navbar-header">';

        // Collapsible button if asked for
        if ($this->collapsible) {
            $html .= '
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>';
        }

        // Add brand if one was given
        if($this->brand) {
            $brand = $this->brand;
            if ($brand['escape']) {
                $html .= Helpers::getContainer('html')->link($this->brand['url'], $this->brand['name'], array('class' => 'navbar-brand'));
            } else {
                $url = $brand['url'];
                $text = $brand['name'];
                $html .= "<a href='$url' class='navbar-brand'>$text</a>";
            }
        }
		
        $html .= '</div>';
		/// --- Header ---
		
		// --- Content ---
        $html .= '<div class="navbar-collapse collapse">';

        // Prints out menus
        if ($this->menus) {
            foreach ($this->menus as $menu) {
                if (is_string($menu)) $html .= $menu; // If is string add to html
                else {
                    $attr  = array_get($menu, 'attributes', array());
                    $html .= Navigation::unstyled($menu['items'], false, $attr, $this->autoroute);
                }
            }
        }

        $html .= '</div>';
		// --- Content ---

        // Close navbar containers
        $html .= '</div></nav>';

        return $html;
    }

    /**
     * Allows creation of inverted navbar
     *
     * @param string $method     The method to call
     * @param array  $parameters An array of parameters
     *
     * @return Navbar
     */
    public static function __callStatic($method, $parameters)
    {        
        if ($method == 'inverse'){
            $attributes = array_get($parameters, 0);
            $type       = array_get($parameters, 1);
            $attributes = Helpers::add_class($attributes, Navbar::INVERSE_BAR);    
            return static::create($attributes, $type);        
        } else return static::create();
    }
}            
