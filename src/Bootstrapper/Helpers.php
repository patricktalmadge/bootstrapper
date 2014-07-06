<?php

namespace Bootstrapper;

use Illuminate\Config\Repository;

class Helpers
{

    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public static function slug($string)
    {
        return preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
    }

    public function css($helper = true)
    {
        $bootstrap = $this->config->get('bootstrapper::bootstrapVersion');
        $string = "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/{$bootstrap}/css/bootstrap.min.css'>";
        if ($helper) {
            $string .= "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/{$bootstrap}/css/bootstrap-theme.min.css'>";
        }

        return $string;
    }

    public function js()
    {
        $jquery = $this->config->get('bootstrapper::jqueryVersion');
        $bootstrap = $this->config->get('bootstrapper::bootstrapVersion');

        return "<script src='http://code.jquery.com/jquery-{$jquery}.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/{$bootstrap}/js/bootstrap.min.js'></script>";
    }
}
