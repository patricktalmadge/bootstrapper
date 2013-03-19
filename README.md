# Bootstrapper 4.0.0

Travis status : [![Build Status](https://secure.travis-ci.org/patricktalmadge/bootstrapper.png?branch=develop)](https://travis-ci.org/patricktalmadge/bootstrapper)

Bootstrapper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.

## Installation

Add the following to your `composer.json` file :

```json
"patricktalmadge/bootstrapper": "dev-develop"
```

Then register Bootstrapper's service provider with Laravel :

```php
'Bootstrapper\BootstrapperServiceProvider',
```

You can then (if you want to) add the following aliases to your `aliases` array in your `config/app.php` file.

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
'Image'          => 'Bootstrapper\\Image',
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

## Using the included Bootstrap assets

As there is no **Asset** class in Laravel 4, Bootstrapper uses the famous [Basset](http://jasonlewis.me/code/basset) package to manage its assets. In order to use the Bootstrap version included with Bootstrapper, you first need to add Basset's Service Provider and facade to your app file. For this refer to Basset's installation instructions.

Once this is done, publish the package assets to your public folder.

```shell
php artisan asset:publish patricktalmadge/bootstrapper
```

And then add the following to your template view file to include the Twitter Bootstrap CSS and Javascript.

```php
{{ Basset::show('bootstrapper.css') }}
{{ Basset::show('bootstrapper.js') }}
```

## Documentation

- [Bootstrapper documentation](http://bootstrapper.aws.af.cm)
- [Twitter Bootstrap documentation](http://twitter.github.com/bootstrap)
- [Twitter Bootstrap on Github](https://github.com/twitter/bootstrap)
