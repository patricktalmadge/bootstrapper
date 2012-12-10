<?php
namespace Bootstrapper;

use \HTML;

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
     * Creates an image with rounded corners
     *
     * @param string $url        An url
     * @param string $alt        An alt text
     * @param array  $attributes An array of attributes
     *
     * @return string An img tag
     */
    public static function rounded($url, $alt = '', $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

        return HTML::image($url, $alt, $attributes);
    }

    /**
     * Creates an image masked with a circle
     *
     * @param string $url        An url
     * @param string $alt        An alt text
     * @param array  $attributes An array of attributes
     *
     * @return string An img tag
     */
    public static function circle($url, $alt = '', $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

        return HTML::image($url, $alt, $attributes);
    }

    /**
     * Creates an image with polaroid borders
     *
     * @param string $url        An url
     * @param string $alt        An alt text
     * @param array  $attributes An array of attributes
     *
     * @return string An img tag
     */
    public static function polaroid($url, $alt = '', $attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'img-'.__FUNCTION__);

        return HTML::image($url, $alt, $attributes);
    }
}
