## Bootstrapper Bundle V. 3.6.8 build 1, by Patrick Talmadge

Bootstrapper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.

##View bundle site for full install instructions.
http://laravelbootstrapper.phpfogapp.com


Install using Artisan CLI:

	php artisan bundle:install bootstrapper

Add the following line to application/bundles.php

	return array(
		'bootstrapper' => array('auto' => true),
	);

Add the following to the application.php config file:

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
	'Tables'		=> 'Bootstrapper\\Tables',
	'Typeahead'             => 'Bootstrapper\\Typeahead', 


Update laravel\database\query.php to use the Bootstrapper Paginator and not the core class by changing the use statement.

	//Change 
	use Laravel\Paginator; 

	//To
	use Paginator;


Publish the bundle assets to your public folder.

	php artisan bundle:publish


Add the following to your template view file to include the Twitter Bootstrap CSS and Javascript.

	Asset::container('bootstrapper')->styles();
	Asset::container('bootstrapper')->scripts();



##Current Twitter Bootstrap version is 2.1.1.

- Homepage:		http://twitter.github.com/bootstrap/
- GitHub:   	https://github.com/twitter/bootstrap/