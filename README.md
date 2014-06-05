# Bootstrapper

Latest stable version: [![Latest Stable Version](https://poser.pugx.org/patricktalmadge/bootstrapper/v/stable.svg)](https://packagist.org/packages/patricktalmadge/bootstrapper)

Travis status : [![Build Status](https://travis-ci.org/patricktalmadge/bootstrapper.svg?branch=develop)](https://travis-ci.org/patricktalmadge/bootstrapper)

Current supported Bootstrap version: 3.1.1

Bootstrapper is a set of classes that allow you to quickly create Twitter Bootstrap 3 style markup.

**THIS USES BOOTSTRAP 3 - If your website breaks after installing
then check the
[migration guide](http://bootply.com/bootstrap-3-migration-guide)**

## Installation

Add the following to your `composer.json` file :

```json
"require": {
"patricktalmadge/bootstrapper": "dev-develop",
},
```

Then register Bootstrapper's service provider with Laravel :

```php
'Bootstrapper\BootstrapperServiceProvider',
```

You can then (if you want to) add the following aliases to your `aliases` array in your `config/app.php` file.

```php
'Alert'          => 'Bootstrapper\\Alert',
'Accordion'      => 'Bootstrapper\\Accordion',
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
'Modal'          => 'Bootstrapper\\Modal',
'Navbar'         => 'Bootstrapper\\Navbar',
'Navigation'     => 'Bootstrapper\\Navigation',
'Paginator'      => 'Bootstrapper\\Paginator',
'Panel'          => 'Bootstrapper\\Panel',
'Progress'       => 'Bootstrapper\\Progress',
'Tabbable'       => 'Bootstrapper\\Tabbable',
'Table'          => 'Bootstrapper\\Table',
'Thumbnail'      => 'Bootstrapper\\Thumbnail',
'Typography'     => 'Bootstrapper\\Typography',
```

## Including Bootstrap

**This package used to use Basset, which is now no longer being actively developed. If you used to use Basset for Bootstrapper alone then you'll need to delete any references to Basset and follow this new guide.**

Include the Bootstrap files just like any other css and js files! Download Bootstrap and JQuery from the [Bootstrap site](http://getbootstrap.com), place them in your public folder and then include them like so:

```php
{{ HTML::style('path/to/bootstrap.css') }}
{{ HTML::script('path/to/jquery.js') }}
{{ HTML::script('path/to/bootstrap.js') }}
```

Feel free to use a CDN, but bear in mind that you may get unexpected functionality if the version you use isn't the version Bootstrapper currently supports (but open an issue to let us know!).

```html
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
```

If you want to get the latest Bootstrap that Bootstrapper supports,
then use the helper function:

```php
Bootstrapper\Helpers::get_CSS()
Bootstrapper\Helpers::get_JS()
```

If you want to stick at a certain version then use

```
artisan config:publish patricktalmadge/bootstrapper
```

And update the config file in app/config/packages.

## Documentation

- [Bootstrapper documentation](http://bootstrapper.eu1.frbit.net/)
- [Twitter Bootstrap documentation](http://getbootstrap.com/)
- [Twitter Bootstrap on Github](https://github.com/twitter/bootstrap)


## Contributing

Contributing is easy! Just fork the repo, make your changes then send a pull request
on GitHub. If your PR is languishing in the queue and nothing seems to be happening, then send
Patrick an [email](mailto:pjr0911025@googlemail.com) or a [tweet](http://twitter.com/DrugCrazed)
