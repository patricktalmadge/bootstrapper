<?php

namespace Bootstrapper\Bridges\Config;


interface ConfigInterface
{

    public function getIconPrefix();

    public function getBootstrapperVersion();

    public function getJQueryVersion();

}