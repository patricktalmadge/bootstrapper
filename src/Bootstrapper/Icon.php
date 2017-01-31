<?php
/**
 * Bootstrapper Icon class
 */

namespace Bootstrapper;

use Bootstrapper\Bridges\Config\ConfigInterface;
use Bootstrapper\Exceptions\IconException;

/**
 * Creates Bootstrap 3 compliant Icons
 *
 * @package Bootstrapper
 */
class Icon extends RenderedObject
{

    /**
     * @var \Illuminate\Config\Repository The config repository
     */
    protected $config;

    /**
     * @var string The icon
     */
    protected $icon;

    /**
     * Creates a new instance of Icon
     *
     * @param ConfigInterface $config The config repository
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Renders the object
     *
     * @return string
     * @throws IconException
     */
    public function render()
    {
        if (is_null($this->icon)) {
            throw IconException::noIconSpecified();
        }

        $baseClass = $this->config->getIconPrefix();
        $icon = $this->icon;
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "$baseClass $baseClass-$icon"
            ]
        );

        $tag = $this->config->getIconTag();

        return "<$tag $attributes></$tag>";
    }

    /**
     * Creates a span link with the correct icon link
     *
     * @param string $icon The icon name
     * @return string
     */
    public function create($icon)
    {
        $this->icon = $this->normaliseIconString($icon);

        return $this;
    }

    /**
     * Magic method to create icons. Meaning the $icon->test is the same as
     * $icon->create('test')
     *
     * @param $method     The icon name
     * @param $parameters The parameters. Not used
     * @return string
     */
    public function __call($method, $parameters)
    {
        return $this->create($method);
    }

    /**
     * Replaces underscores with a minus sign, and convert camelCase to dash
     * separated
     *
     * @param string $icon
     * @return string
     */
    private function normaliseIconString($icon)
    {
        // replace underscores with minus sign
        // and transform from camelCaseString to camel-case-string
        $icon = strtolower(
            preg_replace(
                '/(?<=\\w)(?=[A-Z])/',
                "-$1",
                str_replace('_', '-', $icon)
            )
        );

        return $icon;
    }
}
