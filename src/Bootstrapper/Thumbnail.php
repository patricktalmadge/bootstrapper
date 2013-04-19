<?php
namespace Bootstrapper;

use Closure;
use HtmlObject\Element;
use HtmlObject\Image as HtmlImage;
use HtmlObject\Link;
use HtmlObject\Traits\Tag;
use Underscore\Methods\ArraysMethods as Arrays;
use Underscore\Methods\StringMethods as String;

/**
 * Thumbnails helper class
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
class Thumbnail extends Tag
{

  /**
   * The default element
   *
   * @var string
   */
  protected $element = 'ul';

  /**
   * A Callable to pass the images through
   *
   * @var Callable
   */
  protected $presenter;

  /**
   * Create a new thumbnail grid
   *
   * @param array $attributes
   */
  public function __construct($attributes = array(), Closure $presenter = null)
  {
    $this->attributes = $attributes;
    $this->presenter  = $presenter;

    $this->addClass('thumbnails');
  }

  /**
   * Add an image to the grid
   *
   * @param string|array $imageData An image
   */
  protected function addRichImage($imageData)
  {
    $imageData = $this->present($imageData);

    if ($this->presenter) {
      return $this->nest($imageData);
    }

    // If we provided a rich thumbnail
    $link    = Arrays::get($imageData, 'link');
    $label   = Arrays::get($imageData, 'label');
    $caption = Arrays::get($imageData, 'caption');

    // Create image
    $image = Arrays::get($imageData, 'image');
    $image = HtmlImage::create($image);

    // Linked thumbnail
    if (!$caption and !$label and $link) {
      $image = Link::create($link, $image)->addClass('thumbnail');

    // Plain thumbnail
    } else {
      $thumbnail = Element::create('div', $image)->addClass('thumbnail');
      if($label)   $thumbnail->nest(Element::create('h3', $label));
      if($caption) $thumbnail->nest(Element::create('p', $caption));
      $image = $thumbnail;
    }

    return $this->nest(
      Element::create('li', $image)
    );
  }

  /**
   * Pass an image through a presenter if any
   *
   * @param array|string $image
   *
   * @return array|string
   */
  protected function present($image)
  {
    if ($presenter = $this->presenter) {
      $image = $presenter($image);
    }

    return $image;
  }

  /**
   * Add a plain image
   *
   * @param string $image
   */
  protected function addPlainImage($image)
  {
    $image = $this->present($image);

    // Else just assume we were given an image path
    if (!String::contains($image, '<img')) {
      $image = HtmlImage::create($image);
    }

    return $this->nest(
      Element::create('li', $image)->addClass('thumbnail')
    );
  }

  ////////////////////////////////////////////////////////////////////
  ///////////////////////// STATIC INTERFACE /////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Create a grid of thumbnails
   *
   * @param array    $images    An array of images paths
   * @param Callable $presenter A presenter
   *
   * @return Thumbnail
   */
  public static function create($images = null, Closure $presenter = null, $attributes = array())
  {
    $thumbnails  = new static($attributes, $presenter);

    // Generate the thumbnails
    foreach ($images as $image) {
      if (is_string($image)) $thumbnails->addPlainImage($image);
      else $thumbnails->addRichImage($image);
    }

    return $thumbnails;
  }
}
