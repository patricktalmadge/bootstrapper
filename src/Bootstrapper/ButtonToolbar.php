<?php
namespace Bootstrapper;

/**
 * ButtonToolbar for creating Twitter Bootstrap style Buttons toolbars.
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
class ButtonToolbar
{
    /**
     * Opens a new ButtonToolbar section.
     *
     * @param array $attributes Attributes for the button toolbar
     *
     * @return string A button toolbar
     */
    public static function open($attributes = array())
    {
        $attributes = Helpers::add_class($attributes, 'btn-toolbar');

        return '<div'.Helpers::getContainer('html')->attributes($attributes).'>';
    }

    /**
     * Closes the ButtonToolbar section.
     *
     * @return string
     */
    public static function close()
    {
        return '</div>';
    }
}
