<?php

namespace Bootstrapper\Facades;

class Label extends BootstrapperFacade
{

    const LABEL_PRIMARY = 'label-primary';
    const LABEL_SUCCESS = 'label-success';
    const LABEL_INFO = 'label-info';
    const LABEL_WARNING = 'label-warning';
    const LABEL_DANGER = 'label-danger';
    const LABEL_DEFAULT = 'label-default';

    protected static function getFacadeAccessor()
    {
        return 'label';
    }

}
