<?php

namespace Bootstrapper;

use Illuminate\Config\Repository;

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
     * @param \Illuminate\Config\Repository $config The config repository
     */
    public function __construct(Repository $config)
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
        $baseClass = $this->config->get('bootstrapper::icon_prefix');

        return "<span class='{$baseClass} {$baseClass}-{$icon}'></span>";
    }

    /**
     * Magic method to create icons. Meaning the $icon->test is the same as
     * $icon->create('test')
     *
     * @param $method The icon name
     * @param $parameters The parameters. Not used
     * @return string
     */
    public function __call($method, $parameters)
    {
        return $this->create($method);
    }
}
