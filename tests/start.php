<?php
Bundle::start('bootstrapper');

use Bootstrapper\Alert,
    Bootstrapper\Badges,
    Bootstrapper\Breadcrumbs,
    Bootstrapper\Buttongroup,
    Bootstrapper\Buttons,
    Bootstrapper\ButtonToolbar,
    Bootstrapper\Carousel,
    Bootstrapper\DropdownButton,
    Bootstrapper\Form,
    Bootstrapper\Helpers,
    Bootstrapper\Icons,
    Bootstrapper\Images,
    Bootstrapper\Labels,
    Bootstrapper\Navbar,
    Bootstrapper\Navigation,
    Bootstrapper\Paginator,
    Bootstrapper\Progress,
    Bootstrapper\Splitdropdownbutton,
    Bootstrapper\Tabbable,
    Bootstrapper\Tables,
    Bootstrapper\Typeahead
;

class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  public function testSomething()
  {
    $this->assertTrue(true);
  }
}