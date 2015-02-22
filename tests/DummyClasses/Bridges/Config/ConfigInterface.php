<?php

namespace DummyClasses\Bridges\Config;

class ConfigInterface implements \Bootstrapper\Bridges\Config\ConfigInterface
{

    public function getIconPrefix()
    {
        return 'glyphicon';
    }

    public function getBootstrapperVersion()
    {
        return '3.2.1';
    }

    public function getJQueryVersion()
    {
        return '3.2.1';
    }

}
