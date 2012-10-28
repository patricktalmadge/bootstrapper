<?php

/**
 * Bootstrapper for creating Twitter Bootstrap markup.
 *
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */

/**
* Customized by Raftalks
* ======================
* Following will help users to modify the config/application.php file 
* This way, removes the hassle for the bundle user. :)
**/
$custom_aliases = array(
	'Alert'                 => 'Bootstrapper\\Alert',
	'Badges'                => 'Bootstrapper\\Badges',
	'Breadcrumbs'           => 'Bootstrapper\\Breadcrumbs',
	'Buttons'               => 'Bootstrapper\\Buttons',
	'ButtonGroup'           => 'Bootstrapper\\ButtonGroup',
	'ButtonToolbar'         => 'Bootstrapper\\ButtonToolbar',
	'Carousel'              => 'Bootstrapper\\Carousel',
	'DropdownButton'        => 'Bootstrapper\\DropdownButton',
	'Form'                  => 'Bootstrapper\\Form',
	'Helpers'               => 'Bootstrapper\\Helpers',
	'Icons'                 => 'Bootstrapper\\Icons',
	'Labels'                => 'Bootstrapper\\Labels',
	'Navbar'                => 'Bootstrapper\\Navbar',
	'Navigation'            => 'Bootstrapper\\Navigation',
	'Paginator'             => 'Bootstrapper\\Paginator',
	'Progress'              => 'Bootstrapper\\Progress',
	'SplitDropdownButton'   => 'Bootstrapper\\SplitDropdownButton',
	'Tabbable'              => 'Bootstrapper\\Tabbable',
	'Typeahead'             => 'Bootstrapper\\Typeahead',

);

$laravel_aliases = Laravel\Autoloader::$aliases;
Laravel\Autoloader::$aliases = array_merge($laravel_aliases, $custom_aliases);

//<-- end of the custom addition -->

Autoloader::map(array(
	'Bootstrapper\\Alert'               => __DIR__.'/alert.php',
	'Bootstrapper\\Badges'  	    => __DIR__.'/badges.php',
	'Bootstrapper\\Breadcrumbs'         => __DIR__.'/breadcrumbs.php',
	'Bootstrapper\\ButtonGroup'         => __DIR__.'/buttongroup.php',
	'Bootstrapper\\Buttons'             => __DIR__.'/buttons.php',
	'Bootstrapper\\ButtonToolbar'       => __DIR__.'/buttontoolbar.php',
	'Bootstrapper\\Carousel'            => __DIR__.'/carousel.php',
	'Bootstrapper\\DropdownButton'      => __DIR__.'/dropdownbutton.php',
	'Bootstrapper\\Form'                => __DIR__.'/form.php',
	'Bootstrapper\\Helpers'             => __DIR__.'/helpers.php',
	'Bootstrapper\\Icons'               => __DIR__.'/icons.php',
	'Bootstrapper\\Labels'              => __DIR__.'/labels.php',
	'Bootstrapper\\Navbar'              => __DIR__.'/navbar.php',
	'Bootstrapper\\Navigation'          => __DIR__.'/navigation.php',
	'Bootstrapper\\Paginator'           => __DIR__.'/paginator.php',
	'Bootstrapper\\Progress'            => __DIR__.'/progress.php',
	'Bootstrapper\\SplitDropdownButton' => __DIR__.'/splitdropdownbutton.php',
	'Bootstrapper\\Tabbable'            => __DIR__.'/tabbable.php',
	'Bootstrapper\\Typeahead'           => __DIR__.'/typeahead.php',
));

Asset::container('bootstrapper')->bundle('bootstrapper');

//Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.8.0.js');
Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.8.0.min.js');

//Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.css');
Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.min.css');

//Not Needed if you don't have the top nav bar
Asset::container('bootstrapper')->add('nav-fix',  'css/nav-fix.css');

//Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.css');
Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.min.css');

//Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.js');
Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.min.js');