<?php
namespace Bootstrapper;

/**
 * Media object helper class
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
class MediaObject
{
    /**
     * The current MediaObject instance
     * @var MediaObject
     */
    public static $object;

    /**
     * Whether the MediaObjects should be rendered as a list
     * @var boolean
     */
    protected static $listed = false;

    /**
     * An array of nested Media objects
     * @var array
     */
    public $nested = array();

    /**
     * The body of the media object
     * @var string
     */
    protected $content = null;

    /**
     * The title of the media object
     * @var string
     */
    protected $title = null;

    /**
     * The media of the media object
     * @var string
     */
    protected $media = null;

    /**
     * The media object's attributes
     * @var array
     */
    protected $attributes = array();

    /**
     * Which side the media will be
     * @var string
     */
    protected $pull = 'left';

    /**
     * Statically creates a new MediaObject instance
     *
     * @param  string      $content    Its content
     * @param  string      $media      Its media
     * @param  array       $attributes The media object's attributes
     * @return MediaObject
     */
    public static function create($content, $media = null, $attributes = array())
    {
        static::$object = new static($content);
        if($media) static::$object->with_image($media);
        if($attributes) static::$object->attributes = $attributes;

        return static::$object;
    }

    /**
     * Opens a Media Object list
     *
     * @param  array  $attributes An array of attributes
     * @return string An opening tag
     */
    public static function open_list($attributes = array())
    {
        static::$listed = true;
        $attributes = Helpers::add_class($attributes, 'media-list');

        return '<ul'.Helpers::getContainer('html')->attributes($attributes).'>';
    }

    /**
     * Closes an existing Media Objects list
     *
     * @return string A closing tag
     */
    public static function close_list()
    {
        static::$listed = false;

        return '</ul>';
    }

    /**
     * Creates a new MediaObject instance
     *
     * @param string $content Its content
     * @param string $media   Its media
     */
    public function __construct($content, $media = null)
    {
        $this->content = $content;
    }

    /**
     * Magic methods for MediaObject
     *
     * @param  string      $method     The method called
     * @param  array       $parameters Its parameters
     * @return MediaObject
     */
    public function __call($method, $parameters)
    {
        // Pull the media to a side
        if (starts_with($method, 'pull_')) {
            $side = explode('_', $method);
            $side = array_get($side, 1);

            return $this->pull($side);
        }

        // Add an heading to the media object
        if (starts_with($method, 'with_h')) {
            $heading    = substr($method, -1);
            $title      = array_get($parameters, 0);
            $attributes = array_get($parameters, 1, array());
            $attributes = Helpers::add_class($attributes, 'media-heading');
            $title      = '<h'.$heading.Helpers::getContainer('html')->attributes($attributes).'>'.$title.'</h'.$heading.'>';

            return $this->with_title($title);
        }
    }

    /**
     * Add a media to the MediaObject
     *
     * @param  string      $image      The path to the image
     * @param  string      $alt        Its alt attribute
     * @param  array       $attributes An array of supplementary attributes
     * @return MediaObject
     */
    public function with_image($image, $alt = null, $attributes = array())
    {
        if (!$alt) $alt = $image;

        $attributes  = Helpers::add_class($attributes, 'media-object');
        $this->media = Helpers::getContainer('html')->image($image, $alt, $attributes);

        return $this;
    }

    /**
     * Add a raw title to the MediaObject
     *
     * @param  string      $title The text of the title
     * @return MediaObject
     */
    public function with_title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Pull the media to a side
     *
     * @param  string      $side Left or right
     * @return MediaObject
     */
    public function pull($side)
    {
        if (in_array($side, array('left', 'right'))) {
            $this->pull = $side;
        }

        return $this;
    }

    /**
     * Nests a new instance of MediaObject into the existing one
     *
     * @param  MediaObject $mediaObject The new MediaObject to nest
     * @return MediaObject
     */
    public function nest(MediaObject $mediaObject)
    {
        $this->nested[] = $mediaObject;

        return $this;
    }

    /**
     * Prints out the MediaObject in memory
     *
     * @return string The HTML markup for the media object
     */
    public function __toString()
    {
        // Whether objects should be printed as list elements or divs
        $children = static::$listed ? 'li' : 'div';

        // Open the media object
        $attributes = Helpers::add_class($this->attributes, 'media');
        $html = '<' .$children.Helpers::getContainer('html')->attributes($attributes). '>';

            // Add the media itself
            $html .= '<a class="pull-' .$this->pull. '">';
                $html .= $this->media;
            $html .= '</a>';

            // Add the title and body
            $html .= '<div class="media-body">';
                if($this->title) $html .= $this->title;
                $html .= $this->content;

                // Render nested media objects (always as divs)
                if ($this->nested) {
                    $listed = static::$listed;
                    static::$listed = false;
                    foreach ($this->nested as $mediaObject) {
                        $html .= $mediaObject;
                    }
                    static::$listed = $listed;
                }

            // Close body
            $html .= '</div>';

        // Close object
        $html .='</' .$children. '>';

        return $html;
    }
}
