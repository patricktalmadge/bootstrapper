<?php
/**
 * Bootstrapper Breadcrumb class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant Breadcrumbs
 *
 * @package Bootstrapper
 */
class Breadcrumb extends RenderedObject
{
    /**
     * @var array The links of the breadcrumb
     */
    protected $links = [];

    /**
     * Renders the breadcrumb
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => 'breadcrumb']
        );

        $string = "<ol {$attributes}>";
        foreach ($this->links as $text => $link) {
            $string .= $this->renderLink($text, $link);
        }
        $string .= "</ol>";

        return $string;
    }

    /**
     * Set the links for the breadcrumbs. Expects an array of the following:
     * <ul>
     * <li>An array, with keys <code>link</code> and <code>text</code></li>
     * <li>A string for the active link
     * </ul>
     *
     * @param $links array
     * @return $this
     */
    public function withLinks(array $links)
    {

        $this->links = $links;

        return $this;
    }

    /**
     * Renders the link
     *
     * @param $text
     * @param $link
     * @return string
     */
    protected function renderLink($text, $link)
    {
        $string = "";
        if (is_string($text)) {
            $string .= "<li>";
            $string .= "<a href='{$link}'>{$text}</a>";
        } else {
            $string .= "<li class='active'>";
            $string .= $link;
        }
        $string .= "</li>";

        return $string;
    }
}
