## Bootstrapper V4

Travis status : [![Build Status](https://secure.travis-ci.org/patricktalmadge/bootstrapper.png?branch=master)](https://travis-ci.org/patricktalmadge/bootstrapper)

Bootstrapper is a set of classes that allow you to quickly create Twitter Bootstrap style markup.
This library was originally developed by patrick talmadge (https://github.com/patricktalmadge/bootstrapper)
You can read the documentation here(https://github.com/patricktalmadge/bootstrapper/blob/master/README.md) and try the demo here(http://bootstrapper.aws.af.cm/)

# Enhanced Bootstrapper
I added some nice features:
- A Javascript Injector helper
- Modal component
- Tooltip
- Popover
- Datepicker widget (not part of the twitter implementation)
- Font awesome icons

## Javascript Injector
Tooltip, Popover and Datepicker needs it to produce the necessary javascript dinamically. When you use the above classes, Javascripter stores automatically the javascript code and inject it on your page:
```php
{{Bootstrapper\Javascripter::write_javascript()}}
```
You can also add your own javascript with:
```php
{{Bootstrapper\Javascripter::add_js_snippet('your code here')}}
{{Bootstrapper\Javascripter::add_js_snippet('$("#username").editable();')}}
{{Bootstrapper\Javascripter::write_javascript()}}
```

## Modal Component
It creates a Modal window (http://twitter.github.com/bootstrap/javascript.html#modals)

```php
//Simplest way to create a modal
echo bootstrapper\Modal::create('myModal')
->with_header('This is the Header!')
->with_body('Hello World');

//this create a Modal with Header and Body
echo Bootstrapper\Modal::create('myModal')
->with_header('This is the Header!')
->add_headers(array('This is one more Header!'))
->with_body('Hello World')
->add_body(array(HTML::image('http://bootstrapper.aws.af.cm/img/bootstrap-mdo-sfmoma-01.jpg')));

//This code create a Modal that loads the body from a remote file:
$modal_remote = Bootstrapper\Modal::create('myModalRemote')
->with_header('Remote body example')
->with_data_remote('/body_ext.php');

//The Modal->autoclose bool enable/disable the X button on the header
$modal_remote->autofooter = false;
```
Once you created a Modal you can launch it using a button or an anchor or get the lancher attributes in order to launch it with your own html tag

```php
//This creates an anchor to launch the modal
{{ $modal->get_launch_anchor('Launch myModal via A') }}

//This shortcut creates a button that launchs the modal
{{ $modal->get_launch_button('Launch myModal via Button') }}

//Using the get_launcher_attributes() method you'll print out the necessary attributes to launch the Modal
<a {{$modal->get_launcher_attributes()}}>Open Modal</a>
```

## Tooltip/Popover
With this class you can uses the twitter Tooltips(http://twitter.github.com/bootstrap/javascript.html#tooltips) and Popover(http://twitter.github.com/bootstrap/javascript.html#popovers).
Don't forget to use the Javascripter to animate the tooltips once you created them.

```php
//Simplest way to create a tooltip
This is a tooltip {{Bootstrapper\Tooltip::create('MOUSE HERE', 'This is a nice Tooltip')->get_as_anchor()}}

//This creates a Popover
This is a popover {{Bootstrapper\Tooltip::create('MOUSE HERE', 'Popover's Title', 'This is a nice Popover')->get_as('div')}}

//Creates a tooltip on bottom and codes it like a span
This is a tooltip {{Bootstrapper\Tooltip::create('MOUSE HERE', 'This is a nice Tooltip')->with_placement(Bootstrapper\Tooltip::ON_BOTTOM)->get_as_span()}}

//Uses the Tooltip as label, with Form/Former
{{Former::password("password", Bootstrapper\Tooltip::create('Password', 'This is a nice Tooltip')->get_as_span())}}

//Embeddes the Tooltip into an html (Form) element
echo Bootstrapper\Tooltip::create(Form::text("test2"), 'This is a test Tooltip created on an Html Element')
    ->with_trigger(Bootstrapper\Tooltip::TRIGGER_FOCUS)
    ->with_placement(Bootstrapper\Tooltip::ON_RIGHT)
    ->set_tooltip_for();

//Inject the javascript for the used tooltips/popovers
{{Bootstrapper\Javascripter::write_javascript()}}
```
