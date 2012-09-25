<?php
use Bootstrapper\DropdownButton;

class DropdownButtonTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private $links = array(
    'label' => 'foo', 'url' => '#',
  );

  private function matcher($class = 'normal', $right = false, $dropup = false)
  {
    $class = $class == 'normal' ? null : ' btn-'.$class;
    $right = $right ? 'pull-right ' : null;
    $dropup = $dropup ? ' dropup' : null;

    return
      '<div class="foo btn-group' .$dropup. '" data-foo="bar">'.
        '<button class="' .$class. ' btn dropdown-toggle" type="button" data-toggle="dropdown">'.
          'foo '.
          '<span class="caret"></span>'.
        '</button>'.
        '<ul class="'.$right.'dropdown-menu">'.
          '<li class="divider"></li>'.
          '<li class="divider"></li>'.
        '</ul>'.
      '</div>';
  }

  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('normal'),
      array('custom'),
      array('primary'),
      array('danger'),
      array('warning'),
      array('success'),
      array('info'),
      array('inverse'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->__toString();
    $matcher = $this->matcher();

    $this->assertEquals($matcher, $dropdown);
  }

  public function testRightDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->pull_right()->__toString();
    $matcher = $this->matcher('normal', true);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testDropup()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->dropup()->__toString();
    $matcher = $this->matcher('normal', false, true);

    $this->assertEquals($matcher, $dropdown);
  }

  /**
   * @dataProvider classes
   */
  public function testCallStatic($class)
  {
    $dropdown = DropdownButton::$class('foo', $this->links, $this->testAttributes)->__toString();
    $matcher = $this->matcher($class);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testDynamicAttribute()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->data_foo('bar')->class('foo')->__toString();
    $matcher = $this->matcher();

    $this->assertEquals($matcher, $dropdown);
  }

  public function testMultipleDropdowns()
  {
    $dropdowns =
      DropdownButton::normal('foo', $this->links, $this->testAttributes).
      DropdownButton::normal('bar', $this->links, $this->testAttributes);
    $matcher = $this->matcher().str_replace('foo <span', 'bar <span', $this->matcher());

    $this->assertEquals($matcher, $dropdowns);
  }

  public function testWrongLinks()
  {
    $this->setExpectedException('InvalidArgumentException');

    $dropdown = DropdownButton::normal('foo', 'bar');
  }

  public function testWrongAttributes()
  {
    $this->setExpectedException('InvalidArgumentException');

    $dropdown = DropdownButton::normal('foo', array(), 'bar');
  }
}