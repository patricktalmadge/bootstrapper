<?php
/**
 * Bootstrapper Image facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Label class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Label
 */
class Label extends BootstrapperFacade
{

    const LABEL_PRIMARY = 'label-primary';
    const LABEL_SUCCESS = 'label-success';
    const LABEL_INFO = 'label-info';
    const LABEL_WARNING = 'label-warning';
    const LABEL_DANGER = 'label-danger';
    const LABEL_DEFAULT = 'label-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::label';
    }
}
