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

Autoloader::map(array(
	'Bootstrapper\\Helpers' => __DIR__.'/helpers.php',
	'Bootstrapper\\Alert' => __DIR__.'/alert.php',
	'Bootstrapper\\Form' => __DIR__.'/form.php',
	'Bootstrapper\\Navigation' => __DIR__.'/navigation.php',
	'Bootstrapper\\Tabbable' => __DIR__.'/tabbable.php',
	'Bootstrapper\\Progress' => __DIR__.'/progress.php',
	'BootstrapperBootstrapper\\Badges' => __DIR__.'/badges.php',
	'Bootstrapper\\Labels' => __DIR__.'/labels.php',
	'Bootstrapper\\DropdownButton' => __DIR__.'/dropdownbutton.php',
	'Bootstrapper\\SplitDropdownButton' => __DIR__.'/splitdropdownbutton.php',
	'Bootstrapper\\ButtonGroup' => __DIR__.'/buttongroup.php',
	'Bootstrapper\\ButtonToolbar' => __DIR__.'/buttontoolbar.php',
	'Bootstrapper\\Navbar' => __DIR__.'/navbar.php',
	'Bootstrapper\\Breadcrumbs' => __DIR__.'/breadcrumbs.php',
	'Bootstrapper\\Paginator' => __DIR__.'/paginator.php',
	'Bootstrapper\\Carousel' => __DIR__.'/carousel.php',
	'Bootstrapper\\Typeahead' => __DIR__.'/typeahead.php',
	'Bootstrapper\\Buttons' => __DIR__.'/buttons.php',
));

Asset::container('bootstrapper')->bundle('bootstrapper');

//Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.7.2.js');
Asset::container('bootstrapper')->add('jquery',  'js/jquery-1.7.2.min.js');

//Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.css');
Asset::container('bootstrapper')->add('bootstrap',  'css/bootstrap.min.css');

//Not Needed if you don't have the top nav bar
Asset::container('bootstrapper')->add('nav-fix',  'css/nav-fix.css');

//Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.css');
Asset::container('bootstrapper')->add('bootstrap-responsive',  'css/bootstrap-responsive.min.css');

//Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.js');
Asset::container('bootstrapper')->add('bootstrap-js',  'js/bootstrap.min.js');