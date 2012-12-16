<?php
namespace Bootstrapper;

use \HTML;

/**
 * Modal for creating Twitter Bootstrap Modal.
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
class Modal
{
    /**
     * @var string
     */
    private $name = 'myModal';
    
    /**
     * @var string
     */
    private $data_remote = null;
    
    /**
     * @var string
     */
    private $header = '';
    
    /**
     * @var array
     */
    private $headers = array();
    
    /**
     * @var string
     */
    private $body = '';
    
    /**
     * @var array
     */
    private $bodies = array();
    
    /**
     * @var string
     */
    private $footer = '';
    
    /**
     * @var array
     */
    private $footers = array();
    
    /**
     * The current Modal's attributes
     *
     * @var string
     */
    private $attributes  = '';

    /**
     * Whether the current Modal should use the close button
     *
     * @var boolean
     */
    private $autoclose   = true;

    /**
     * Create a new Modal instance.
     *
     * @param string $name       The name of Modal to create
     * @param array $attributes An array of attributes for the current Modal
     *
     * @return Modal
     */
    public static function create($name = null, $attributes = null)
    {
        // Fetch current instance
        $instance = new Modal;

        if (!is_null($name) && is_string($name)) {
            $instance->name = $name;
        }

        if (is_null($attributes) || !is_array($attributes)) {
            $attributes = array();
        }
        //data-remote="/mmfansler/aQ3Ge/show/"

        $defaultAttributes['class'] = 'modal hide fade';
        $defaultAttributes['tabindex'] = '-1';
        $defaultAttributes['role'] = 'dialog';
        $defaultAttributes['aria-labelledby'] = $instance->name;
        $defaultAttributes['aria-hidden'] = 'true';

        if (!is_null($attributes)) {
            $instance->attributes .= HTML::attributes(array_merge($defaultAttributes, $attributes));
        }

        return $instance;
    }

    /**
     * Add elements or strings to the current Modal Header
     *
     * @param mixed $header      An array of items or a string
     * @return Modal
     */
    public function with_data_remote($remote_url)
    {
        if (is_string($remote_url)) 
            $this->attributes .= ' data-remote="'.$remote_url.'" ';

        return $this;
    }

    /**
     * Add elements or strings to the current Modal Header
     *
     * @param mixed $header      An array of items or a string
     * @return Modal
     */
    public function with_header($header)
    {
        if (is_string($header)) $this->header = $header;
        if (is_array($header)) $this->headers = $header;

        return $this;
    }

    /**
     * Add elements to the current Modal Header
     *
     * @param array $header      An array of items
     * @return Modal
     */
    public function add_headers($header)
    {
        if (is_array($header)) 
            $this->headers =array_merge_recursive($this->headers,$header);

        return $this;
    }

    /**
     * Add elements or strings to the current Modal body
     *
     * @param mixed $body      An array of items or a string
     * @return Modal
     */
    public function with_body($body)
    {
        if (is_string($body)) $this->body = $body;
        if (is_array($body)) $this->bodies = $body;

        return $this;
    }

    /**
     * Add elements to the current Modal Header
     *
     * @param array $header      An array of items
     * @return Modal
     */
    public function add_body($bodies)
    {
        if (is_array($bodies)) 
            $this->bodies =array_merge_recursive($this->bodies,$bodies);

        return $this;
    }

    /**
     * Add array or strings to the current Modal Footer
     *
     * @param mixed $footer      An array of items or a string
     * @return Modal
     */
    public function with_footer($footer)
    {
        if (is_string($footer)) $this->footer = $footer;
        if (is_array($footer)) $this->footers = $footer;

        return $this;
    }

    /**
     * Add elements to the current Modal footer
     *
     * @param array $footer      An array of items
     * @return Modal
     */
    public function add_footers($footers)
    {
        if (is_array($footers)) 
            $this->footers =array_merge_recursive($this->footers,$footers);

        return $this;
    }

    /**
     * Prints out the current Modal in case it doesn't do it automatically
     *
     * @return string A Modal
     */
    public function get()
    {
        return static::__toString();
    }

    /**
     * Create a simple button that launches the Modal.show()
     *
     * @param string $button_text       The button's text
     * @param array $attributes         An array of attributes for the current button
     * @return string                   A button to use as launcher
     */
    public function get_launch_button($button_text, $attributes = null)
    {
        $defaultAttributes = 'class="btn" type="button" data-toggle="modal" ';
        if (is_array($attributes)) {
            $defaultAttributes .= HTML::attributes($attributes);
        }
        $html  = '<button '.$defaultAttributes.' data-target="#'.$this->name.'">'.$button_text.'</button>';
        return $html;
    }

    /**
     * Create a simple <anchor> that launches the Modal.show()
     *
     * @param string $button_text       The anchor's text
     * @param array $attributes         An array of attributes for the current anchor
     * @return string                   An anchor to use as launcher
     */
    public function get_launch_anchor($a_text, $attributes = null)
    {
        $defaultAttributes = 'class="btn" role="button" data-toggle="modal" ';
        if (is_array($attributes)) {
            $defaultAttributes .= HTML::attributes($attributes);
        }
        $html  = '<a '.$defaultAttributes.' data-target="#'.$this->name.'">'.$a_text.'</a>';
        return $html;
    }

    /**
     * Writes the current Modal
     *
     * @return string A Bootstrap Modal
     */
    public function __toString()
    {
        // Open Modal containers
        $html  = '<div id="'.$this->name.'" '.$this->attributes.'>';

        $html .= '<div class="modal-header">';
        if ($this->autoclose) {
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        }
        if (!empty($this->header))
            $html .= '<h3>'.$this->header.'</h3>';
        if (!empty($this->headers))
            $html .= implode(PHP_EOL, $this->headers);
        $html .= '</div>';

        $html .= '<div class="modal-body">';
        if (!empty($this->body))
            $html .= '<p>'.$this->body.'</p>';
        if (!empty($this->bodies))
            $html .= implode(PHP_EOL, $this->bodies);
        $html .= '</div>';

        $html .= '<div class="modal-footer">';
        if (!empty($this->footer))
            $html .= '<p>'.$this->footer.'</p>';
        if (!empty($this->footers))
            $html .= implode(PHP_EOL, $this->footers);
        if (empty($this->footer) && empty($this->footers)) {
            $html .= '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
        }

        $html .= '</div>';

        // Close Modal containers
        $html .= '</div>';

        return $html;
    }
}
