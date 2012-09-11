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
    array('Bootstrapper' => Bundle::path('bootstrapper') . 'libraries')
);

Asset::container('bootstrapper')->bundle('bootstrapper');

//Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.8.1.js');
Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.8.1.min.js');

//Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.css');
Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.min.css');

//Not Needed if you don't have the top nav bar
Asset::container('bootstrapper')->add('nav-fix',  'css/nav-fix.css');

//Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.css');
Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.min.css');

//Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.js');
Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.min.js');