<?php
/**
 * Bootstrapper Table facade
 */

namespace Bootstrapper\Facades;

/**
 * Facade for the Table class
 *
 * @package Bootstrapper\Facades
 * @see     Bootstrapper\Table
 */
class Table extends BootstrapperFacade
{

    const TABLE_STRIPED = 'table-striped';
    const TABLE_BORDERED = 'table-bordered';
    const TABLE_HOVER = 'table-hover';
    const TABLE_CONDENSED = 'table-condensed';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootstrapper::table';
    }
}
