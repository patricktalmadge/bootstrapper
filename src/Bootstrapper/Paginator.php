<?php
namespace Bootstrapper;

use \HTML;

/**
 * Paginator for creating Twitter Bootstrap pagination.
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
class Paginator extends \Laravel\Paginator
{
    /**
     * Paginator types
     * @var constant
     */
    const ALIGN_LEFT   = '';
    const ALIGN_CENTER = ' pagination-centered';
    const ALIGN_RIGHT  = ' pagination-right';

    const SIZE_DEFAULT = '';
    const SIZE_LARGE   = ' pagination-large';
    const SIZE_SMALL   = ' pagination-small';
    const SIZE_MINI    = ' pagination-mini';

    protected $pager_aligned = false;

    /**
     * The "dots" element used in the pagination slider.
     *
     * @var string
     */
    protected $dots = '<li class="disabled"><a href="#">...</a></li>';

    /**
     * Create the HTML pagination links.
     *
     * @param bool $align align pager
     *
     * @return string
     */
    public function pager($align = false)
    {
        $this->pager_aligned = $align;

        return '<ul class="pager">'.$this->previous().$this->next().'</ul>';
    }

    /**
     * Create the HTML pagination links.
     *
     * Typically, an intelligent, "sliding" window of links will be rendered based
     * on the total number of pages, the current page, and the number of adjacent
     * pages that should rendered. This creates a beautiful paginator similar to
     * that of Google's.
     *
     * Example: 1 2 ... 23 24 25 [26] 27 28 29 ... 51 52
     *
     * If you wish to render only certain elements of the pagination control,
     * explore some of the other public methods available on the instance.
     *
     * <code>
     *      // Render the pagination links
     *      echo $paginator->links();
     *
     *      // Render the pagination links using a given window size
     *      echo $paginator->links(5);
     * </code>
     *
     * @param int    $adjacent  Number of adjacent items
     * @param string $alignment Alignment of pagination
     *
     * @return string
     */
    public function links($adjacent = 3, $alignment = self::ALIGN_LEFT, $size = self::SIZE_DEFAULT)
    {
        if ($this->last <= 1) return '';

        // The hard-coded seven is to account for all of the constant elements in a
        // sliding range, such as the current page, the two ellipses, and the two
        // beginning and ending pages.
        //
        // If there are not enough pages to make the creation of a slider possible
        // based on the adjacent pages, we will simply display all of the pages.
        // Otherwise, we will create a "truncating" sliding window.
        if ($this->last < 7 + ($adjacent * 2)) {
            $links = $this->range(1, $this->last);
        } else {
            $links = $this->slider($adjacent);
        }

        $content = $this->previous().' '.$links.' '.$this->next();


        $attributes = array("class" => "pagination".$alignment.$size);

        return '<div'.HTML::attributes($attributes).'><ul>'.$content.'</ul></div>';
    }


    /**
     * Create a chronological pagination element, such as a "previous" or "next" link.
     *
     * @param string  $element  Pagination element
     * @param int     $page     Curent page
     * @param string  $text     Text for current element
     * @param Closure $disabled function to determine if disabled or not
     *
     * @return string
     */
    protected function element($element, $page, $text, $disabled)
    {
        $class = $this->pager_aligned ? "{$element}" : "";

        if (is_null($text)) {
            $text = \Lang::line("pagination.{$element}")->get($this->language);
        }

        // Each consumer of this method provides a "disabled" Closure which can
        // be used to determine if the element should be a span element or an
        // actual link. For example, if the current page is the first page,
        // the "first" element should be a span instead of a link.
        if ($disabled($this->page, $this->last)) {
            $class .= " disabled";

            return '<li'.HTML::attributes(compact("class")).'><a href="#">'.HTML::entities($text).'</a></li>';
        } else {
            return '<li'.HTML::attributes(compact("class")).'>'.$this->link($page, $text, null).'</li>';
        }
    }



    /**
     * Build a range of numeric pagination links.
     *
     * For the current page, an HTML span element will be generated instead of a link.
     *
     * @param int $start starting position
     * @param int $end   ending position
     *
     * @return string
     */
    protected function range($start, $end)
    {
        $pages = array();

        // To generate the range of page links, we will iterate through each page
        // and, if the current page matches the page, we will generate a span,
        // otherwise we will generate a link for the page. The span elements
        // will be assigned the "current" CSS class for convenient styling.
        for ($page = $start; $page <= $end; $page++) {
            if ($this->page == $page) {
                $pages[] = '<li class="active"><a href="#">'.HTML::entities($page).'</a></li>';
            } else {
                $pages[] = '<li>'.$this->link($page, $page, null).'</li>';
            }
        }

        return implode(' ', $pages);
    }
}
