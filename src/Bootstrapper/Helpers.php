<?php
/**
 * Bootstrapper Helper functions
 */

namespace Bootstrapper;

use Bootstrapper\Bridges\Config\ConfigInterface;

/**
 * Helper class
 *
 * @package Bootstrapper
 */
class Helpers
{
    /**
     * @var array The number of times each class has been called
     */
    private static $counts = [
    ];

    /**
     * The config repository
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;


    /**
     * Creates a new instance of the helpers class
     *
     * @param ConfigInterface $config The config interface
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Slugifies a string
     *
     * @param string $string
     * @return mixed
     */
    public static function slug($string)
    {
        return preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
    }

    /**
     * Outputs a link to the Bootstrap CDN
     *
     * @param bool $withTheme Gets the bootstrap theme as well
     * @return string
     */
    public function css($withTheme = true)
    {
        $version = $this->config->getBootstrapperVersion();
        $string = "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/{$version}/css/bootstrap.min.css'>";
        if ($withTheme) {
            $string .= "<link rel='stylesheet' "
            . "href='//netdna.bootstrapcdn.com/bootstrap/{$version}/css/bootstrap-theme.min.css'>";
        }

        return $string;
    }

    /**
     * Outputs a link to the Jquery and Bootstrap CDN
     *
     * @return string
     */
    public function js()
    {
        $jquery = $this->config->getJQueryVersion();
        $bootstrap = $this->config->getBootstrapperVersion();

        return "<script src='//code.jquery.com/jquery-{$jquery}.min.js'></script>"
        . "<script src='//netdna.bootstrapcdn.com/bootstrap/{$bootstrap}/js/bootstrap.min.js'></script>";
    }

    /**
     * Generate an id of the form "x-class-name-x". These should always be
     * unique.
     *
     * @param RenderedObject $caller The object that called this
     * @return string A unique id
     */
    public static function generateId(RenderedObject $caller)
    {
        $class = get_class($caller);

        if (isset(self::$counts[$class])) {
            $count = self::$counts[$class];
            self::$counts[$class] += 1;
        } else {
            $count = 1;
            self::$counts[$class] = 2;
        }

        return static::slug(implode(' ', [$count, $class, $count]));
    }
}
