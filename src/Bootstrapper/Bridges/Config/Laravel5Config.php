<?php

namespace Bootstrapper\Bridges\Config;

use Illuminate\Contracts\Config\Repository;

class Laravel5Config implements ConfigInterface
{

    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getIconPrefix()
    {
        return $this->repository->get('bootstrapper.icon_prefix');
    }

    public function getIconTag()
    {
        return $this->repository->get('bootstrapper.icon_tag');
    }

    public function getBootstrapperVersion()
    {
        return $this->repository->get('bootstrapper.bootstrapVersion');
    }

    public function getJQueryVersion()
    {
        return $this->repository->get('bootstrapper.jqueryVersion');
    }
}
