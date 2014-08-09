<?php

namespace Bootstrapper;

use Illuminate\Config\Repository;

class Icon
{

    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function create($icon)
    {
        $baseClass = $this->config->get('bootstrapper::icon_prefix');

        return "<span class='{$baseClass} {$baseClass}-{$icon}'></span>";
    }

    public function __call($method, $parameters)
    {
        return $this->create($method);
    }
}
