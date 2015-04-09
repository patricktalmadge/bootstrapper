<?php
/**
 * Bootstrapper ProgressBar facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for ProgressBar
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\ProgressBar
 */
class ProgressBar extends BootstrapperFacade
{

    const PROGRESS_BAR_SUCCESS = 'progress-bar-success';
    const PROGRESS_BAR_INFO = 'progress-bar-info';
    const PROGRESS_BAR_WARNING = 'progress-bar-warning';
    const PROGRESS_BAR_DANGER = 'progress-bar-danger';
    const PROGRESS_BAR_NORMAL = 'progress-bar-default';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::progressbar';
    }
}
