<?php
/**
 * Bootstrapper Navbar class
 */

namespace Bootstrapper;

use Illuminate\Routing\UrlGenerator;

/**
 * Creates Bootstrap 3 compliant navbars
 *
 * @package Bootstrapper
 */
class Navbar extends RenderedObject
{

    /**
     * Constant for inverse navbars
     */
    const NAVBAR_INVERSE = 'navbar-inverse';

    /**
     * Constant for static navbars
     */
    const NAVBAR_STATIC = 'navbar-static-top';

    /**
     * Constant for navbars that are stuck to the top
     */
    const NAVBAR_TOP = 'navbar-fixed-top';

    /**
     * Constant for navbars fixed to the bottom
     */
    const NAVBAR_BOTTOM = 'navbar-fixed-bottom';

    /**
     * @var string The brand of the navbar
     */
    protected $brand;

    /**
     * @var UrlGenerator A Laravel URL generator
     */
    protected $url;

    /**
     * @var array The content of the array
     */
    protected $content = [];

    /**
     * @var string The type of the navbar
     */
    protected $type = 'navbar-default';

    /**
     * @var string The position of the navbar
     */
    protected $position;

    /**
     * @var bool Whether the content is fluid or not
     */
    protected $fluid = false;

    /**
     * Creates a new Navbar
     *
     * @param UrlGenerator $url A Laravel URL generator
     */
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * Renders the navbar
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "navbar {$this->type} {$this->position}",
                'role' => 'navigation'
            ]
        );

        $string = "<div {$attributes}>";
        $string .= $this->fluid ?
            "<div class='container-fluid'>" :
            "<div class='container'>";
        $string .= $this->renderHeader();
        $string .= $this->renderContent();
        $string .= "</div></div>";

        return $string;
    }

    /**
     * Renders the inner content
     *
     * @return string
     */
    protected function renderContent()
    {
        $string = "<nav class='navbar-collapse collapse'>";

        foreach ($this->content as $item) {
            if (is_a($item, 'Bootstrapper\\Navigation')) {
                $item->navbar();
            }
            $string .= $item;
        }

        $string .= "</nav>";

        return $string;
    }

    /**
     * Renders the header
     *
     * @return string
     */
    protected function renderHeader()
    {
        $string = "<div class='navbar-header'>";
        // Add the collapse button
        $string .= "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>";
        $string .= "<span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span>";
        $string .= "<span class='icon-bar'></span><span class='icon-bar'></span></button>";
        if ($this->brand) {
            $string .= "<a class='navbar-brand' href='{$this->brand['link']}'>{$this->brand['brand']}</a>";
        }
        $string .= "</div>";

        return $string;
    }

    /**
     * Sets the brand of the navbar
     *
     * @param string      $brand The brand
     * @param null|string $link  The link. If not set we default to linking to
     *                           '/' using the UrlGenerator
     * @return $this
     */
    public function withBrand($brand, $link = null)
    {
        if (!isset($link)) {
            $link = $this->url->to('/');
        }

        $this->brand = compact('brand', 'link');

        return $this;
    }

    /**
     * Sets the brand of the navbar
     *
     * @param string      $image   The brand image
     * @param null|string $link    The link. If not set we default to linking to
     *                             '/' using the UrlGenerator
     * @param string      $altText The alt text for the image
     * @return $this
     */
    public function withBrandImage($image, $link = null, $altText = '')
    {
        $altText = $altText !== '' ? " alt='{$altText}'" : '';

        return $this->withBrand("<img src='{$image}'{$altText}>", $link);
    }

    /**
     * Adds some content to the navbar
     *
     * @param mixed $content Anything that can become a string! If you pass in a
     *                       Bootstrapper\Navigation object we'll make sure
     *                       it's a navbar on render.
     * @return $this
     */
    public function withContent($content)
    {
        $this->content[] = $content;

        return $this;
    }

    /**
     * Sets the navbar to be inverse
     *
     * @param string $position
     * @param array  $attributes
     * @return $this
     */
    public function inverse($position = null, $attributes = [])
    {
        if (isset($position)) {
            $this->setPosition($position);
            $this->withAttributes($attributes);
        }

        $this->setType(self::NAVBAR_INVERSE);

        return $this;
    }

    /**
     * Sets the position to top
     *
     * @return $this
     */
    public function staticTop()
    {
        $this->setPosition(self::NAVBAR_STATIC);

        return $this;
    }

    /**
     * Sets the type of the navbar
     *
     * @param string $type The type of the navbar. Assumes that the navbar-
     *                     prefix is there
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the position of the navbar
     *
     * @param string $position The position of the navbar. Assumes that the
     *                         navbar- prefix is there
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Sets the position of the navbar to the top
     *
     * @return $this
     */
    public function top()
    {
        $this->setPosition(self::NAVBAR_TOP);

        return $this;
    }

    /**
     * Sets the position of the navbar to the bottom
     *
     * @return $this
     */
    public function bottom()
    {
        $this->setPosition(self::NAVBAR_BOTTOM);

        return $this;
    }

    /**
     * Creates a navbar with a position and attributes
     *
     * @param string $position   The position of the navbar
     * @param array  $attributes The attributes of the navbar
     * @return $this
     */
    public function create($position, $attributes = [])
    {
        $this->setPosition($position);

        return $this->withAttributes($attributes);
    }

    /**
     * Sets the navbar to be fluid
     *
     * @return $this
     */
    public function fluid()
    {
        $this->fluid = true;

        return $this;
    }
}
