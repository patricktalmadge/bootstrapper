<?php
namespace Bootstrapper;

use \HTML;

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
class Thumbnail
{
  public static function create($images = null, $closure = null)
  {
    $thumbnails  = '<ul class="thumbnails">';

      // Generate the thumbnails
      foreach ($images as $image) {

        // If we provide a closure
        if (is_callable($closure)) {
          $thumbnails .= $closure($image);
          continue;
        }

        // If we provided a rich thumbnail
        if (is_array($image)) {
          $link    = array_get($image, 'link');
          $label   = array_get($image, 'label');
          $caption = array_get($image, 'caption');
          $image   = array_get($image, 'image');

          $thumbnails .= '<li>';

            // Linked thumbnail
            if (!$caption and !$label and $link) {
              $image = HTML::image($image);
              $thumbnails .= HTML::decode( HTML::link($link, $image, array('class' => 'thumbnail')) );

            // Plain thumbnail
            } else {
              $thumbnails .= '<div class="thumbnail">';
                $thumbnails .= HTML::image($image);
                if($label) $thumbnails .= '<h3>' .$label. '</h3>';
                if($caption) $thumbnails .= '<p>' .$caption. '</p>';
              $thumbnails .= '</div>';
            }
          $thumbnails .= '</li>';
          continue;
        }

        // Else just assume we were given an image path
        if(!str_contains($image, '<img')) $image = HTML::image($image);
        $thumbnails .= '<li class="thumbnail">'.$image.'</li>';
      }

    $thumbnails .= '</ul>';

    return $thumbnails;
  }
}
