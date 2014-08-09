<?php

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

class BootstrapperFacade extends Facade
{
    public static $instances = [];

    public static function __callStatic($method, $args)
    {
        $instance = clone static::getInstance(static::getFacadeAccessor());

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

    private static function getInstance($facade)
    {
        if (!isset(static::$instances[$facade]))
        {
            static::$instances[$facade] = static::getFacadeRoot();
        }

        return static::$instances[$facade];
    }
} 