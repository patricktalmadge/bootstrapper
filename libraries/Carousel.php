<?php
namespace Bootstrapper;

use \HTML;

/**
 * Carousel for creating Twitter Bootstrap style Carousels.
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
class Carousel
{
    /**
     * The current Carousel instance
     * @var Carousel
     */
    private static $carousel;

    /**
     * How data will be fetched from each object/entry
     * @var array
     */
    private $schema = array(
        'key'        => 'id',
        'alt'        => 'alt_text',
        'attributes' => 'attributes',
        'caption'    => 'caption',
        'label'      => 'label',
        'image'      => 'image',
    );

    /**
     * The carousel's items
     * @var array
     */
    private $items = array();

    /**
     * The carousel's attributes
     * @var array
     */
    private $attributes = array();

    /**
     * The previous button content
     * @var string
     */
    private $prev = '&lsaquo;';

    /**
     * The next button content
     * @var string
     */
    private $next = '&rsaquo;';

    /**
     * The current carousel's hash
     * @var string
     */
    private $hash = null;

    /**
     * The current active element in the carousel
     * @var integer
     */
    private $active = null;

    /**
     * Create a Bootstrap carousel. Returns the HTML for the carousel.
     *
     * @param array $items      An array of carousel items
     * @param array $attributes Attributes to apply the carousel itself
     *
     * @return Carousel
     */
    public static function create($items, $attributes = array())
    {
        static::$carousel = new static($items, $attributes);

        return static::$carousel;
    }

    /**
     * Renders a Carousel navigation for custom carousels
     *
     * @param  string $id   The Carousel ID
     * @param  string $prev The previous link text
     * @param  string $next The next link text
     * @return string A Carousel navigation
     */
    public static function navigation($id, $prev, $next)
    {
        $navigation  = HTML::link($id, $prev, array('class' => 'carousel-control left',  'data-slide' => 'prev'));
        $navigation .= HTML::link($id, $next, array('class' => 'carousel-control right', 'data-slide' => 'next'));

        return $navigation;
    }

    /**
     * Creates a new Carousel instance
     *
     * @param array $items      The items to use as pictures
     * @param array $attributes Its attributes
     */
    public function __construct($items, $attributes = array())
    {
        $this->items = $items;
        $this->attributes = Helpers::add_class($attributes, 'carousel slide');

        // Set default active item
        $this->active = key($items);

        // Calculate the Carousel ID
        $this->hash = '#'.array_get($attributes, 'id', 'carousel_'.Helpers::rand_string(5));
    }

    /**
     * Magic methods for the Carousel class
     *
     * @param  string   $method     The method
     * @param  array    $parameters Its parameters
     * @return Carousel
     */
    public function __call($method, $parameters)
    {
        // Dynamic schema editing
        // Example : ->as_label('name') and $item->name/$item['name'] will be used as label
        if (starts_with($method, 'as_')) {
            $use = substr($method, 3);
            if(!isset($this->schema[$use])) return $this;
            else {
                $this->schema[$use] = array_get($parameters, 0);
            }
        }

        return $this;
    }

    /**
     * Changes the text for the prev link
     *
     * @param  string   $prev The new text
     * @return Carousel
     */
    public function prev($next)
    {
        $this->prev = $prev;

        return $this;
    }

    /**
     * Changes the text for the next link
     *
     * @param  string   $next The new text
     * @return Carousel
     */
    public function next($next)
    {
        $this->next = $next;

        return $this;
    }

    /**
     * Set which element will be the active one
     *
     * @param  integer  $key A key
     * @return Carousel
     */
    public function active($key)
    {
        $this->active = $key;

        return $this;
    }

    /**
     * Set the current Carousel's #id
     *
     * @param  string   $id The new id
     * @return Carousel
     */
    public function id($id)
    {
        $this->hash = '#'.$id;

        return $this;
    }

    /**
     * Use a custom object schema for the images passed
     *
     * @param  array    $schema A schema array
     * @return Carousel
     */
    public function with_schema($schema)
    {
        $this->schema = (array) array_merge($this->schema, $schema);

        return $this;
    }

    /**
     * Prints out the current Carousel instance
     *
     * @return string A carousel
     */
    public function __toString()
    {
        // Render main wrapper
        $this->attributes['id'] = substr($this->hash, 1);
        $html = '<div'.HTML::attributes($this->attributes).'>';

            // Render items
            $html .= '<div class="carousel-inner">';
                foreach ($this->items as $key => $item) {
                    $html .= $this->createItem($item, $key);
                }
            $html .= '</div>';

            // Render navigation
            $html .= Carousel::navigation($this->hash, $this->prev, $this->next);
        $html .= '</div>';

        return $html;
    }

    //////////////////////////////////////////////////////////////////
    ///////////////////////////// HELPERS ////////////////////////////
    //////////////////////////////////////////////////////////////////

    /**
     * Create a carousel item. Returns a HTML element for one slide.
     *
     * @param  array  $item A carousel item to render
     * @param  bool   $key  A fallback key as the item's position in the array
     * @return string
     */
    protected function createItem($item, $key)
    {
        // Gather necessary variables
        $key        = $this->getFromItem($item, 'key', $key);
        $altText    = $this->getFromItem($item, 'alt');
        $attributes = $this->getFromItem($item, 'attributes', array());
        $caption    = $this->getFromItem($item, 'caption');
        $label      = $this->getFromItem($item, 'label');
        $image      = $this->getFromItem($item, 'image');

        // If we were given an array of image paths instead of arrays
        if (!$image and is_string($item)) $image = $item;

        // Build HTML
        $active = $this->active == $key ? ' active' : null;
        $html = '<div class="item'.$active.'">';

        // Render the image
        $html .= HTML::image($image, $altText, $attributes);

        // If we have a caption, render it
        if ($caption or $label) {
            $html .= '<div class="carousel-caption">';
            if ($label)   $html .= '<h4>'.$label.'</h4>';
            if ($caption) $html .= '<p>'.$caption.'</p>';
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * Get a piece of data from an item
     *
     * @param  mixed  $item     The item
     * @param  string $key      The key to fetch
     * @param  string $fallback A fallback to use
     * @return string A data from the item
     */
    private function getFromItem($item, $key, $fallback = null)
    {
        $key = $this->schema[$key];

        if (is_object($item)) {
            return isset($item->$key) ? $item->$key : $fallback;
        } else {
            return array_get($item, $key, $fallback);
        }
    }
}
