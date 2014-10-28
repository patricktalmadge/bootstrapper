<?php
/**
 * Bootstrapper Icon facade
 */

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for Icon class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Icon
 */
class Icon extends Facade
{

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::icon';
    }

}