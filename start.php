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

$libs_path = __DIR__.'/libraries';

Autoloader::map(array(
	'Bootstrapper\\Alert'               => $libs_path.'/alert.php',
	'Bootstrapper\\Badges'              => $libs_path.'/badges.php',
	'Bootstrapper\\Breadcrumbs'         => $libs_path.'/breadcrumbs.php',
	'Bootstrapper\\ButtonGroup'         => $libs_path.'/buttongroup.php',
	'Bootstrapper\\Buttons'             => $libs_path.'/buttons.php',
	'Bootstrapper\\ButtonToolbar'       => $libs_path.'/buttontoolbar.php',
	'Bootstrapper\\Carousel'            => $libs_path.'/carousel.php',
	'Bootstrapper\\DropdownButton'      => $libs_path.'/dropdownbutton.php',
	'Bootstrapper\\Form'                => $libs_path.'/form.php',
	'Bootstrapper\\Helpers'             => $libs_path.'/helpers.php',
	'Bootstrapper\\Icons'               => $libs_path.'/icons.php',
	'Bootstrapper\\Images'              => $libs_path.'/images.php',
	'Bootstrapper\\Labels'              => $libs_path.'/labels.php',
	'Bootstrapper\\Navbar'              => $libs_path.'/navbar.php',
	'Bootstrapper\\Navigation'          => $libs_path.'/navigation.php',
	'Bootstrapper\\Paginator'           => $libs_path.'/paginator.php',
	'Bootstrapper\\Progress'            => $libs_path.'/progress.php',
	'Bootstrapper\\SplitDropdownButton' => $libs_path.'/splitdropdownbutton.php',
	'Bootstrapper\\Tabbable'            => $libs_path.'/tabbable.php',
	'Bootstrapper\\Tables'              => $libs_path.'/tables.php',
	'Bootstrapper\\Typeahead'           => $libs_path.'/typeahead.php',
));

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