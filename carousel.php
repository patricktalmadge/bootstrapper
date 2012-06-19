<?php namespace Bootstrapper;

use \HTML;

/**
 * Carousel for creating Twitter Bootstrap style Carousels.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Carousel 
{
	/**
	 * @var string the previous button content.
	 */
	public static $prev = '&lsaquo;';

	/**
	 * @var string the next button content.
	 */
	public static $next = '&rsaquo;';

	/**
	 * Create a Bootstrap carousel. Returns the HTML for the carousel.
	 *
	 * @param  array   $items
	 * @param  array   $attributes
	 * @return Carousel
	 */
	public static function create($items, $attributes = array())
	{
		$attributes = Helpers::add_class($attributes, 'carousel slide');

		if(!isset($attributes['id'])){
			$attributes['id'] = "carousel_".Helpers::rand_string(5);
		}

		$html = '<div'.HTML::attributes($attributes).'>';
		$html .= '<div class="carousel-inner">';

		$first = true;
		foreach ($items as $item)
		{
			$html .= static::createItem($item, $first);
			$first = false;
		}

 	 	$html .= '</div>';

  		$html .= '<a class="carousel-control left" href="#'.$attributes['id'].'" data-slide="prev">'.Carousel::$prev.'</a>';
  		$html .= '<a class="carousel-control right" href="#'.$attributes['id'].'" data-slide="next">'.Carousel::$next.'</a>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Create a carousel item. Returns a HTML element for one slide.
	 *
	 * @param  array   $item
	 * @param  bool    $is_active
	 * @return string
	 */
	protected static function createItem($item, $is_active)
	{
		//Set defaults if not set
		if(!isset($item['alt_text'])) 
		{
			$item['alt_text'] = '';
		}

		if(!isset($item['attributes']))
		{
			$item['attributes'] = array();
		}

		if(!isset($item['label']))
		{ 
			$item['label'] = '';
		}

		if(!isset($item['caption']))
		{ 
			$item['caption'] = '';
		}

		$active = $is_active ? ' active' : '';

		//Build HTML
		$html = '<div class="item'.$active.'">';
		$html .= HTML::image($item['image'], $item['alt_text'], $item['attributes']);
		$html .= '<div class="carousel-caption">';
        $html .= '<h4>'.$item['label'].'</h4>';
        $html .= '<p>'.$item['caption'].'</p>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
	}
}