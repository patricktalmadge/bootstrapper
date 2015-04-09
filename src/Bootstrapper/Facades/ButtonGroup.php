<?php
/**
 * Bootstrapper Button Group facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for ButtonGroup
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\ButtonGroup
 */
class ButtonGroup extends BootstrapperFacade
{
    const LARGE = 'btn-group-lg';
    const SMALL = 'btn-group-sm';
    const EXTRA_SMALL = 'btn-group-xs';

    const NORMAL = 'btn-default';
    const PRIMARY = 'btn-primary';
    const SUCCESS = 'btn-success';
    const INFO = 'btn-info';
    const WARNING = 'btn-warning';
    const DANGER = 'btn-danger';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::buttongroup';
    }
}
