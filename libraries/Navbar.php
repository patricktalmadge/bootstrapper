<?php
namespace Bootstrapper;

use \HTML;

/**
 * Navbar for creating Twitter Bootstrap style Navbar.
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
class Navbar
{
    /**
     * The current Navbar's attributes
     *
     * @var array
     */
    private $attributes  = array();

    /**
     * Whether the current Navbar should use automatic routing
     *
     * @var boolean
     */
    private $autoroute   = true;

    /**
     * Contains the current Navbar's brand (if there is one)
     *
     * @var array
     */
    private $brand       = array();

    /**
     * Whether the current Navbar should be collapsible or not
     *
     * @var boolean
     */
    private $collapsible = false;

    /**
     * All menus or elements of the current Navbar
     *
     * @var array
     */
    private $menus       = array();

    /**
     * The current Navbar's type
     *
     * @var constant
     */
    private $type        = Navbar::STATIC_BAR;

    /**
     * The Navbar types
     * @var constant
     */
    const STATIC_BAR = '';
    const FIX_TOP    = 'navbar-fixed-top';
    const FIX_BOTTOM = 'navbar-fixed-bottom';

    /**
     * Create a new Navbar instance.
     *
     * @param array $attributes An array of attributes for the current navbar
     * @param const $type       The type of Navbar to create
     *
     * @return Navbar
     */
    public static function create($attributes = array(), $type = Navbar::STATIC_BAR)
    {
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
    public function with_brand($brand, $brand_url)
    {
        $this->brand = array(
            'name' => $brand,
            'url'  => $brand_url,
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
    public function get()
    {
        return static::__toString();
    }

    /**
     * Writes the current Navbar
     *
     * @return string A Bootstrap navbar
     */
    public function __toString()
    {
        $attributes = Helpers::add_class($this->attributes, 'navbar '.$this->type);

        // Open navbar containers
        $html  = '<div'.HTML::attributes($attributes).'>';
        $html .= '<div class="navbar-inner"><div class="container">';

        // Collapsible button if asked for
        if ($this->collapsible) {
            $html .= '
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>';
        }

        // Add brand if one was given
        if($this->brand)
            $html .= HTML::link($this->brand['url'], $this->brand['name'], array('class' => 'brand'));

        if($this->collapsible)
            $html .= '<div class="nav-collapse">';

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

        if($this->collapsible)
            $html .= '</div>';

        // Close navbar containers
        $html .= '</div></div></div>';

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
        if ($method == 'inverse') {
            $attributes = array_get($parameters, 0);
            $type       = array_get($parameters, 1);
            $attributes = Helpers::add_class($attributes, 'navbar-inverse');

            return static::create($attributes, $type);
        } else return static::create();
    }
}
