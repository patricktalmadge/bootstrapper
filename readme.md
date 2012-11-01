# Bootstrapper V4, by Patrick Talmadge

Bootstrapper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.

## Installation

Install using Artisan CLI:

```shell
php artisan bundle:install bootstrapper
```

Add the following line to application/bundles.php

```php
'bootstrapper' => array('auto' => true),
```

Add the following to the application.php config file:

```php
'Alert'          => 'Bootstrapper\\Alert',
'Badge'          => 'Bootstrapper\\Badge',
'Breadcrumb'     => 'Bootstrapper\\Breadcrumb',
'Button'         => 'Bootstrapper\\Button',
'ButtonGroup'    => 'Bootstrapper\\ButtonGroup',
'ButtonToolbar'  => 'Bootstrapper\\ButtonToolbar',
'Carousel'       => 'Bootstrapper\\Carousel',
'DropdownButton' => 'Bootstrapper\\DropdownButton',
'Form'           => 'Bootstrapper\\Form',
'Helpers'        => 'Bootstrapper\\Helpers',
'Icon'           => 'Bootstrapper\\Icon',
'Label'          => 'Bootstrapper\\Label',
'MediaObject'    => 'Bootstrapper\\MediaObject',
'Navbar'         => 'Bootstrapper\\Navbar',
'Navigation'     => 'Bootstrapper\\Navigation',
'Paginator'      => 'Bootstrapper\\Paginator',
'Progress'       => 'Bootstrapper\\Progress',
'Tabbable'       => 'Bootstrapper\\Tabbable',
'Table'          => 'Bootstrapper\\Table',
'Thumbnail'      => 'Bootstrapper\\Thumbnail',
'Typeahead'      => 'Bootstrapper\\Typeahead',
'Typography'     => 'Bootstrapper\\Typography',
```

Update `laravel\database\query.php` to use the Bootstrapper Paginator and not the core class by changing the use statement.

```php
// Change
use Laravel\Paginator;

// To
use Paginator;
```

Publish the bundle assets to your public folder.

```shell
php artisan bundle:publish
```

Add the following to your template view file to include the Twitter Bootstrap CSS and Javascript.

```php
Asset::container('bootstrapper')->styles();
Asset::container('bootstrapper')->scripts();
```

## View bundle site for full install instructions.

http://laravelbootstrapper.phpfogapp.com

## Current Twitter Bootstrap version is 2.1.1

- Homepage:		http://twitter.github.com/bootstrap/
- GitHub:   	https://github.com/twitter/bootstrap/