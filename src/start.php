<?php

/**
 * Bootstrapper for creating Twitter Bootstrap markup.
 *
 * @category   HTML/UI
 * @package    Boostrapper
 * @subpackage Twitter
 * @author     Patrick Talmadge - <ptalmadge@gmail.com>
 * @license    MIT License <http://www.opensource.org/licenses/mit>
 * @link       http://laravelbootstrapper.phpfogapp.com/
 *
 * @see        http://twitter.github.com/bootstrap/
 */

// Autoload Boostrapper
Autoloader::namespaces(
    array('Bootstrapper' => Bundle::path('bootstrapper') . 'src' .DS. 'Bootstrapper')
);

// Define main assets
Asset::container('bootstrapper')
    ->bundle('bootstrapper')
    ->add('bootstrap',            'css/bootstrap.min.css')
    ->add('bootstrap-responsive', 'css/bootstrap-responsive.min.css')
    ->add('jquery',               'js/jquery-1.9.1.min.js')
    ->add('bootstrap-js',         'js/bootstrap.min.js', 'jquery');

// Define unminified version of the assets
Asset::container('bootstrapper-unminified')
    ->bundle('bootstrapper')
    ->add('bootstrap',            'css/bootstrap.css')
    ->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
    ->add('jquery',               'js/jquery-1.9.1.js')
    ->add('bootstrap-js',         'js/bootstrap.js', 'jquery');