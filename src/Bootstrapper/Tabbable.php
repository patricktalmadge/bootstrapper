<?php
namespace Bootstrapper;

use \HTML;
use Bootstrapper\Navigation;

/**
 * Tabbable for creating Twitter Bootstrap. Bootstrap JS is required.
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
class Tabbable
{
    /**
     * All menu or elements of the current Tabbable
     *
     * @var array
     */
    private $menu = array();

    /**
     * The placement of the current Tabble item
     *
     * @var enum
     */
    private $placement = Tabbable::PLACEMENT_ABOVE;

    /**
     * The style of the current Tabble item
     *
     * @var enum
     */
    private $style = Navigation::TYPE_TABS;

    /**
     * Whether the current Tabble item should stacked or not
     *
     * @var boolean
     */
    private $stacked = false;

    /**
     * The current Tabbable's attributes
     *
     * @var array
     */
    private $attributes = array();

    /**
     * Set the current Tabbables menu attributes
     *
     * @var array
     */
    private $menu_attributes = array();


    /**
     * Set the current Tabbables content attributes
     *
     * @var array
     */
    private $content_attributes = array();

    /**
     * Whether the current Tabble item should use automatic routing
     *
     * @var boolean
     */
    private $autoroute = true;

    /**
     * Tabs placements
     * @var constant
     */
    const PLACEMENT_ABOVE = 'tabs-above';
    const PLACEMENT_BELOW = 'tabs-below';
    const PLACEMENT_LEFT  = 'tabs-left';
    const PLACEMENT_RIGHT = 'tabs-right';


    /**
     * Generate a Bootstrap tabbable object.
     *
     * @param array $menu       Tab items
     * @param array $attributes Attributes for the tabs
     *
     * @return string
     */
    public static function create($menu, $attributes = array())
    {
        // Fetch current instance
        $instance = new Tabbable;

        // Save given parameters
        $instance->menu       = $menu;
        $instance->attributes = $attributes;

        return $instance;
    }

    /**
     * Set the placement to Tabbable enum
     *
     * @param string $placement The new placement value
     *
     * @return Tabbable
     */
    public function placement($placement)
    {
        $this->placement = $placement;

        return $this;
    }

    /**
     * Set the menu style to Navigation enum
     *
     * @param string $style The new menu style value
     *
     * @return Tabbable
     */
    public function style($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Set the stacked value to true or false
     *
     * @param boolean $stacked The new stacked value
     *
     * @return Tabbable
     */
    public function stacked($stacked = true)
    {
        $this->stacked = $stacked;

        return $this;
    }

    /**
     * Add menus or strings to the current Tabbable
     *
     * @param array $attributes An array of attributes to use
     *
     * @return Tabbable
     */
    public function menu_attributes($attributes = array())
    {
        $this->menu_attributes = $attributes;

        return $this;
    }

    /**
     * Add attributes to the content of the current Tabbable
     *
     * @param array $attributes An array of attributes to use
     *
     * @return Tabbable
     */
    public function content_attributes($attributes)
    {
        $this->content_attributes = $attributes;

        return $this;
    }

    /**
     * Set the autoroute to true or false
     *
     * @param boolean $autoroute The new autoroute value
     *
     * @return Tabbable
     */
    public function autoroute($autoroute)
    {
        $this->autoroute = $autoroute;

        return $this;
    }

    /**
     * Prints out the current Tabbable in case it doesn't do it automatically
     *
     * @return string A Tabbable
     */
    public function get()
    {
        return static::__toString();
    }

    /**
     * Writes the current Tabbable
     *
     * @return string A Bootstrap Tabbable
     */
    public function __toString()
    {
        $content = array();
        $list = static::normalize($this->menu, $content);

        $tabs = Navigation::menu($list, $this->style, $this->stacked, $this->menu_attributes, $this->autoroute);

        // Tab content container
        if (!isset($this->content_attributes['class'])) {
            $this->content_attributes['class'] = 'tab-content';
        } else {
            $this->content_attributes['class'] .= ' tab-content';
        }

        $content = '<div '.HTML::attributes($this->content_attributes).'>'. implode('', $content).'</div>';

        $html = '<div class="tabbable '.$this->placement.'"'.HTML::attributes($this->attributes).'>';
        $html .= $this->placement === self::PLACEMENT_BELOW ? $content.$tabs : $tabs.$content;
        $html .= '</div>';

        return $html;
    }

    /**
     * Normalizes the items list and correct urls if any are set.
     *
     * @param array $items Tab items
     * @param array &$panes array of panes
     * @param int   &$i     index
     *
     * @return array
     */
    protected static function normalize($items, &$panes, &$i = 0)
    {
        $id = Helpers::rand_string(5);
        $tabs = array();

        if (!is_array($items)) return false;

        foreach ($items as $key => $tab) {
            $url = '#';
            if (isset($tab['items'])) {

                $tab['items'] = static::normalize($tab['items'], $panes, $i);
            } else {
                if (!isset($tab['url'])) {
                    $tab['url'] = '';
                }

                $tabId = 'tab_'.$id.'_'.$i;

                //if not disabled set toggle and url
                if (!isset($tab['disabled']) || !$tab['disabled']) {
                    $tab['attributes'] = array('data-toggle' => 'tab');
                    $url .= $tabId;
                }

                $class = 'tab-pane';
                if (isset($tab['active']) && $tab['active']) {
                    $class .= ' active';
                }

                $panes[] = '<div class="'.$class.'" id="'.$tabId.'">'.$tab['url'].'</div>';

                $tab['url'] = $url;
                $i++;
            }
            $tabs[] = $tab;
        }

        return $tabs;
    }

    /**
     * Checks call to see if we can create a tabbable from a magic call (for you wizards).
     * tabs_above, tabs_left, pills, lists, etc...
     *
     * @param string $method     Method name
     * @param array  $parameters Method parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $method_array = explode('_', strtolower($method));

        $list_styles = array('tabs', 'pills', 'lists');
        $style_found = array_intersect($method_array, $list_styles);

        // Check for placment
        $list_placement = array('above', 'below', 'left', 'right');
        $placement_found = array_intersect($method_array, $list_placement);

        if (count($style_found) > 0) {
            // Check list parameters
            $menu = array_get($parameters, 0);
            if (!(isset($menu) && is_array($menu))) {
                throw new \Exception("Tabbable requires an array of menu items");
            }

            $attributes = array_get($parameters, 1);
            if (isset($attributes) && !is_array($attributes)) {
                throw new \Exception("Tabbable attributes parameter should be an array of attributes");
            }

            $inst = static::create($menu, $attributes);

            //Set placement
            if (count($placement_found) > 0 ) {
                $placement = $placement_found[key($placement_found)];
                $inst->placement('tabs-'.$placement);
            }

            //Set Style
            if (count($style_found) > 0 ) {
                $style = $style_found[key($style_found)];

               // Hack to get around dynamic list call
                if ($style === 'lists') {
                    $style = 'list';
                }

                $inst->style('nav-'.$style);
            }

            return $inst;
        }

        throw new \Exception("Method [$method] does not exist.");
    }
}
