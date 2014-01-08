<?php
namespace Bootstrapper;

/**
 * Image class for wrapping images with Bootstrap classes
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
class Image
{

  /**
   * The alt text of the image
   */
  private $alt = '';

  /**
   * The attributes of the image
   */
  private $attributes = array();

  /**
   * The location of the image
   */
  private $url = '';
  
  /**
   * Catch-all method
   */
  public static function __callStatic($method, $parameters)
  {
    $url        = array_get($parameters, 0);
    $alt        = array_get($parameters, 1);
    $attributes = array_get($parameters, 2);

    return new static($method, $url, $alt, $attributes);
  }

  /**
   * Creates a Bootstrap image
   *
   * @param string $type       The image type
   * @param string $url        An url
   * @param string $alt        An alt text
   * @param array  $attributes An array of attributes
   *
   * @return string An img tag
   */
  public function __construct($type, $url, $alt, $attributes)
  {
    $attributes = Helpers::add_class($attributes, 'img-'.$type);

    $this->attributes = $attributes;
    $this->url = $url;
    $this->alt = $alt;

    return $this;
    
  }

  public function render() {
    return Helpers::getContainer('html')->image($this->url, $this->alt, $this->attributes);
  }

  public function __toString() {
    return $this->render();
  }

  public function responsive() {
    $this->attributes = Helpers::add_class($this->attributes, 'img-responsive');
    
    return $this;
  }
}
