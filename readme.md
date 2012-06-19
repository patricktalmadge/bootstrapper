## Bootstraper Bundle, by Patrick Talmadge

Bootstraper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.

##View bundle site for full install instructions.
http://bootstraper.phpfogapp.com/


Install using Artisan CLI:

	php artisan bundle:install bootstraper

Add the following line to application/bundles.php

	return array(
		'bootstraper' => array('auto' => true),
	);

Change Form and Paginator in the application.php config file to:

	'Form' 			=> 'Bootstraper\\Form',
	'Paginator'		=> 'Bootstraper\\Paginator',

Add the following to the application.php config file:

	'Alert' 		=> 'Bootstraper\\Alert',
	'Tabbable' 		=> 'Bootstraper\\Tabbable',
	'Navigation'	=> 'Bootstraper\\Navigation',
	'Progress'		=> 'Bootstraper\\Progress',
	'Badges'		=> 'Bootstraper\\Badges',
	'Labels'		=> 'Bootstraper\\Labels',
	'DropdownButton'=> 'Bootstraper\\DropdownButton',
	'SplitDropdownButton'=> 'Bootstraper\\SplitDropdownButton',
	'ButtonGroup'	=> 'Bootstraper\\ButtonGroup',
	'ButtonToolbar'	=> 'Bootstraper\\ButtonToolbar',
	'Navbar'		=> 'Bootstraper\\Navbar',
	'Breadcrumbs'	=> 'Bootstraper\\Breadcrumbs',
	'Carousel'		=> 'Bootstraper\\Carousel',
	'Typeahead'		=> 'Bootstraper\\Typeahead',
	'Buttons'		=> 'Bootstraper\\Buttons',


Publish the bundle assets to your public folder.

	php artisan bundle:publish


Add the following to your template view file to include the Twitter Bootstrap CSS and Javascript.

	Asset::container('bootstraper')->styles();
	Asset::container('bootstraper')->scripts();



##Current Twitter Bootstrap version is 2.0.4.

- Homepage:		http://twitter.github.com/bootstrap/
- GitHub:   	https://github.com/twitter/bootstrap/