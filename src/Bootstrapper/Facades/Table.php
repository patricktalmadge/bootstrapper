<?php

namespace Bootstrapper\Facades;

class Table extends BootstrapperFacade 
{

    const TABLE_STRIPED = 'table-striped';
    const TABLE_BORDERED = 'table-bordered';
    const TABLE_HOVER = 'table-hover';
    const TABLE_CONDENSED = 'table-condensed';

    protected static function getFacadeAccessor()
    {
        return 'table';
    }

}
