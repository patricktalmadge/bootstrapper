<?php

/**
 * Bootstraper for creating Twitter Bootstrap markup.
 * 
 * @package     Bundles
 * @subpackage  Twitter
 * @author      Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */

Autoloader::map(array(
	'Bootstraper\\Helpers' => __DIR__.'/helpers.php',
	'Bootstraper\\Alert' => __DIR__.'/alert.php',
	'Bootstraper\\Form' => __DIR__.'/form.php',
	'Bootstraper\\Navigation' => __DIR__.'/navigation.php',
	'Bootstraper\\Tabbable' => __DIR__.'/tabbable.php',
	'Bootstraper\\Progress' => __DIR__.'/progress.php',
	'Bootstraper\\Badges' => __DIR__.'/badges.php',
	'Bootstraper\\Labels' => __DIR__.'/labels.php',
	'Bootstraper\\DropdownButton' => __DIR__.'/dropdownbutton.php',
	'Bootstraper\\SplitDropdownButton' => __DIR__.'/splitdropdownbutton.php',
	'Bootstraper\\ButtonGroup' => __DIR__.'/buttongroup.php',
	'Bootstraper\\ButtonToolbar' => __DIR__.'/buttontoolbar.php',
	'Bootstraper\\Navbar' => __DIR__.'/navbar.php',
	'Bootstraper\\Breadcrumbs' => __DIR__.'/breadcrumbs.php',
	'Bootstraper\\Paginator' => __DIR__.'/paginator.php',
	'Bootstraper\\Carousel' => __DIR__.'/carousel.php',
	'Bootstraper\\Typeahead' => __DIR__.'/typeahead.php',
	'Bootstraper\\Buttons' => __DIR__.'/buttons.php',
));

Asset::container('bootstraper')->bundle('bootstraper');

//Asset::container('bootstraper')->add('jquery',  'js/jquery-1.7.2.js');
Asset::container('bootstraper')->add('jquery',  'js/jquery-1.7.2.min.js');

//Asset::container('bootstraper')->add('bootstrap',  'css/bootstrap.css');
Asset::container('bootstraper')->add('bootstrap',  'css/bootstrap.min.css');

//Not Needed if you don't have the top nav bar
Asset::container('bootstraper')->add('nav-fix',  'css/nav-fix.css');

//Asset::container('bootstraper')->add('bootstrap-responsive',  'css/bootstrap-responsive.css');
Asset::container('bootstraper')->add('bootstrap-responsive',  'css/bootstrap-responsive.min.css');

//Asset::container('bootstraper')->add('bootstrap-js',  'js/bootstrap.js');
Asset::container('bootstraper')->add('bootstrap-js',  'js/bootstrap.min.js');