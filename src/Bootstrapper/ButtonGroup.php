<?php
namespace Bootstrapper;

use Illuminate\Support\Facades\HTML;

/**
 * ButtonGroup for creating Twitter Bootstrap style Buttons groups.
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
class ButtonGroup
{

  const NORMAL = 'btn-default';
  const PRIMARY = 'btn-primary';
  const SUCCESS = 'btn-success';
  const INFO = 'btn-info';
  const DANGER = 'btn-danger';
  const LINK = 'btn-link';

  private static function makeContents($contents = array(), $type) {
    $string = '';
    foreach($contents as $button) {
      $class = "btn " . $button[0];
      $content = $button[1];
      $attributes = isset($button[2]) ? $button[2] : array();
      $attributes = Helpers::add_class($attributes, $type, 'type');
      $string .= "<label class='" . $class . "'>";
      $string .= "<input ". Helpers::getContainer('html')->attributes($attributes) . ">" . $content;
      $string .= "</label>";
    }
    return $string;
  }

  private static function make($type, $contents = array(), $attributes = array()) {
    $attributes = Helpers::add_class($attributes, 'buttons', 'data-toggle');
    $attributes = Helpers::add_class($attributes, 'btn-group');
    $string = "<div " . Helpers::getContainer('html')->attributes($attributes) .  ">";
    $string .= static::makeContents($contents, $type);
    $string .= "</div>";
    return $string;
  }

  public static function radio($contents = array(), $attributes = array()) {
    return static::make('radio', $contents, $attributes);
  }

  public static function checkbox($contents = array(), $attributes = array()) {
    return static::make('checkbox', $contents, $attributes);
  }


}
