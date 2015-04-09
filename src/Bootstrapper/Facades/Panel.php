<?php
/**
 * Bootstrapper panel facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Panel class
 *
 * @package Bootstrapper\Facades
 */
class Panel extends BootstrapperFacade
{

    const PRIMARY = 'panel-primary';
    const SUCCESS = 'panel-success';
    const INFO = 'panel-info';
    const WARNING = 'panel-warning';
    const DANGER = 'panel-danger';
    const NORMAL = 'panel-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::panel';
    }
}
