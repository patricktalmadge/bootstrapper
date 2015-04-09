<?php
/**
 * Bootstrapper Alert facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for Bootstrapper Alerts
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Alert
 */
class Alert extends BootstrapperFacade
{
    const INFO = 'alert-info';
    const SUCCESS = 'alert-success';
    const WARNING = 'alert-warning';
    const DANGER = 'alert-danger';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::alert';
    }
}
