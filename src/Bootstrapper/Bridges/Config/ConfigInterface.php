<?php

namespace Bootstrapper\Bridges\Config;

interface ConfigInterface
{

    public function getIconPrefix();

    public function getIconTag();

    public function getBootstrapperVersion();

    public function getJQueryVersion();
}
