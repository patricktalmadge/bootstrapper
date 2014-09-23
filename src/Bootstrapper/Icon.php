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
        $icon = $this->__normaliseIconString($icon);
        
        return "<span class='{$baseClass} {$baseClass}-{$icon}'></span>";
    }

    public function __call($method, $parameters)
    {
        return $this->create($method);
    }
    
    private function __normaliseIconString($icon)
    {
        // replace underscores with minus sign
        // and transform from camelCaseString to camel-case-string
        $icon = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', "-$1", str_replace('_', '-', $icon)));
        
        return $icon;
    }
}
