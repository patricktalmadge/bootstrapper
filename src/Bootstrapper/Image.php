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
     * Catch-all method
     */
    public static function __callStatic($method, $parameters)
    {
        $url        = array_get($parameters, 0);
        $alt        = array_get($parameters, 1);
        $attributes = array_get($parameters, 2);

        return static::create($method, $url, $alt, $attributes);
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
    protected static function create($type, $url, $alt, $attributes)
    {
        $attributes = Helpers::add_class($attributes, 'img-'.$type);

        return Helpers::getContainer('html')->image($url, $alt, $attributes);
    }
}
