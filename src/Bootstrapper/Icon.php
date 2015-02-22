<?php
/**
 * Bootstrapper Icon class
 */

namespace Bootstrapper;

use Bootstrapper\Bridges\Config\ConfigInterface;

/**
 * Creates Bootstrap 3 compliant Icons
 *
 * @package Bootstrapper
 */
class Icon
{

    /**
     * @var \Illuminate\Config\Repository The config repository
     */
    protected $config;

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
     * Creates a span link with the correct icon link
     *
     * @param string $icon The icon name
     * @return string
     */
    public function create($icon)
    {
        $baseClass = $this->config->getIconPrefix();
        $icon = $this->normaliseIconString($icon);

        return "<span class='{$baseClass} {$baseClass}-{$icon}'></span>";
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
