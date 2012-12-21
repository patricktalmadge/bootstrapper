<?php
namespace Bootstrapper;

use \HTML;

/*  USAGE
testing a tooltip {{Bootstrapper\Tooltip::create('HERE', 'This is a nice Tooltip')->with_placement(Bootstrapper\Tooltip::ON_BOTTOM)->get_as_anchor()}}

{{Former::password("password", Bootstrapper\Tooltip::create('Password', 'This is a nice Tooltip')->get_as_span())}}

echo Bootstrapper\Tooltip::create(Form::text("test2"), 'This is a test Tooltip created on an Html Element')
    ->with_trigger(Bootstrapper\Tooltip::TRIGGER_FOCUS)
    ->with_placement(Bootstrapper\Tooltip::ON_RIGHT)
    ->set_tooltip_for();

echo Bootstrapper\Tooltip::create(Form::text("test"), 'This is a test Tooltip')
    ->with_placement(Bootstrapper\Tooltip::ON_RIGHT)
    ->get_as('span');
*/

/**
 * Tooltip for creating Twitter Bootstrap Tooltip.
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
class Tooltip
{
    const ON_TOP = 'top';
    const ON_BOTTOM = 'bottom';
    const ON_LEFT = 'left';
    const ON_RIGHT = 'right';
    
    const TRIGGER_HOVER = 'hover';
    const TRIGGER_CLICK = 'click';
    const TRIGGER_FOCUS = 'focus';
    const TRIGGER_MANUAL = 'manual';

    const TYPE_TOOLTIP = 'tooltip';
    const TYPE_POPOVER = 'popover';

    /**
     * @var const
     */
    public $type = Tooltip::TYPE_TOOLTIP;

    /**
     * @var string
     */
    public $name = 'myTooltip';

    /**
     * @var string
     */
    public $tooltip_title = 'Tooltip here';

    /**
     * @var string
     */
    public $tooltip_content = null;

    /**
     * @var string
     */
    public $remote_content = null;

    /**
     * @var string
     */
    public $display_text = '';

    /**
     * @var string
     */
    public $placement = Tooltip::ON_TOP;
    
    /**
     * @var string
     */
    public $trigger = Tooltip::TRIGGER_HOVER;
    
    /**
     * @var bool
     */
    public $animation = true;
    
     /**
     * @var bool
     */
    public $selector = false;
    
     /**
     * @var bool
     */
    public $html = false;
    
    /**
     * Create a new Tooltip instance.
     *
     * @param string $display_text       The text where to apply the tooltip
     * @param string $tooltip_title       The title of Tooltip to create
     * @param string $tooltip_content       Popover content (Only for popover)
     *
     * @return Tooltip
     */
    public static function create($display_text = null, $tooltip_title = null, $tooltip_content = null)
    {
        // Fetch current instance
        $instance = new Tooltip;

        if (!is_null($tooltip_title) && is_string($tooltip_title)) {
            $instance->tooltip_title = $tooltip_title;
        }

        if (!is_null($tooltip_content)) {
            $instance->type = Tooltip::TYPE_POPOVER;
            $instance->tooltip_content = $tooltip_content;
        }

        if (!is_null($display_text)) {
            $instance->display_text = $display_text;
        }

        return $instance;
    }

    /**
     * Set the content for the current Popover
     *
     * @param string $content      the content of the popover
     * @return Tooltip
     */
    public function with_content($content = true)
    {
        $this->tooltip_content = $content;

        return $this;
    }

    /**
     * Set the content for the current Popover
     *
     * @param string $date      the content of the popover
     * @return Tooltip
     */
    public function with_remote_content($content)
    {
        $this->remote_content = $content;

        return $this;
    }

    /**
     * Set the animation for the current Tooltip
     *
     * @param string $animation      is animated?
     * @return Tooltip
     */
    public function with_animation($animation = true)
    {
        $this->animation = $animation;

        return $this;
    }

    /**
     * @param const $trigger
     * @return Tooltip
     */
    public function with_trigger($trigger = Tooltip::TRIGGER_HOVER)
    {
        $this->trigger = $trigger;
        return $this;
    }

    /**
     * @param const $placement
     * @return Tooltip
     */
    public function with_placement($placement = Tooltip::ON_TOP)
    {
        $this->placement = $placement;
        return $this;
    }

    /**
     * @param string $selector
     * @return Tooltip
     */
    public function with_selector($selector = false)
    {
        $this->selector = $selector;

        return $this;
    }

    /**
     * @param string $html
     * @return Tooltip
     */
    public function with_html($html = false)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Writes the current Tooltip
     *
     * @return string A Bootstrap Tooltip
     */
    public function __toString()
    {
        return $this->get_as_anchor();
    }

    /**
     * Writes the current Tooltip as $tag
     *
     * @return string
     */
    public function get_as($tag)
    {
        $html = '<'.$tag.$this->create_attributes().'>'.$this->display_text.'</'.$tag.'>';
        return $html;
    }

    public function get_as_anchor()
    {
        $html = '<a href="#" '.$this->create_attributes().'>'.$this->display_text.'</a>';
        return $html;
    }

    public function get_as_span()
    {
        return $this->get_as('span');
    }

    /**
     * @param array $htmlelement An html element where to put the tooltip
     *
     * @return Tooltip
     */
    public function set_tooltip_for($htmlelement = null)
    {
        if (is_null($htmlelement) || !is_string($htmlelement))
            $htmlelement = $this->display_text;

        if (substr($htmlelement, 0, 1) != '<') 
            return $this->get_as_span();

        $attributes = $this->create_attributes();
        return str_replace(' ', " $attributes ", $htmlelement);
    }

    /**
     * Create attributes id, data-date, data-date-format
     *
     * @param array $attributes     In case you want to override the attributes
     * @return string                   A button to use as launcher
     */
    private function create_attributes($attributes = null)
    {
        $defaultAttributes = array();
        $defaultAttributes['rel'] = $this->type;
        $defaultAttributes['data-original-title'] = $this->tooltip_title;
        $defaultAttributes['data-placement'] = $this->placement;
        if ($this->tooltip_content) $defaultAttributes['data-content'] = $this->tooltip_content;
        if ($this->remote_content) $defaultAttributes['data-poload'] = $this->remote_content;
        if (!$this->animation) $defaultAttributes['data-animation'] = 'false';
        if ($this->selector) $defaultAttributes['data-selector'] = $this->selector;
        if ($this->html) $defaultAttributes['data-html'] = 'true';
        if ($this->trigger != Tooltip::TRIGGER_HOVER || $this->type == Tooltip::TYPE_POPOVER) $defaultAttributes['data-trigger'] = $this->trigger;

        if (!is_null($attributes) && is_array($attributes)) {
            $defaultAttributes = array_merge($defaultAttributes, $attributes);
        }

        Javascripter::add_js_snippet('$("[rel='.$this->type.']").'.$this->type.'();');
        return HTML::attributes($defaultAttributes);
    }
}
