<?php
/**
 * Bootstrapper generic facade
 */

namespace Bootstrapper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for Bootstrapper classes. Have to use this because Laravel is a bit
 * too clever for our liking and gives us the same instance each time. This
 * is not helpful when we're using something like this and we have several
 * instances of the object in use.
 *
 * @package Bootstrapper\Facades
 */
class BootstrapperFacade extends Facade
{
    /**
     * @var array A cache of the various instances
     */
    public static $instances = [];

    /**
     * Calls a static method
     *
     * @param string $method The method
     * @param array  $args   The arguments
     * @return mixed A Bootstrapper object
     */
    public static function __callStatic($method, $args)
    {
        $facadeAccessor = static::getFacadeAccessor();

        $instance = clone static::getInstance($facadeAccessor);

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
                return $instance->$method(
                    $args[0],
                    $args[1],
                    $args[2],
                    $args[3]
                );

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

    /**
     * Get an instance out of the IoC, or the cached instance
     *
     * @param string $facade The facade accessor
     * @return mixed The Bootstrapper object
     */
    private static function getInstance($facade)
    {
        if (!isset(static::$instances[$facade])) {
            static::$instances[$facade] = static::getFacadeRoot();
        }

        return static::$instances[$facade];
    }
}
