<?php
include_once '_start.php';

use Bootstrapper\DropdownButton;
use Bootstrapper\Navigation;

class DropdownButtonTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private $links;

  protected function setUp()
  {
    parent::setUp();

    $this->links = Navigation::links(array(array('foo', '#'),array('bar','#')));
  }

  private function matcher($class = 'normal', $right = false, $dropup = false, $split = false)
  {
    $class = $class == 'normal' ? ' btn-default' : ' btn-'.$class;
    $right = $right ? 'pull-right ' : null;
    $dropup = $dropup ? ' dropup' : null;

    if ($split) {
      $btn = '<button class="' .$class. ' btn" type="button">foo</button>'.
        '<button class="' .$class. ' btn dropdown-toggle" type="button" data-toggle="dropdown"> <span class="caret"></span></button>';
    } else {
      $btn = '<button class="' .$class. ' btn dropdown-toggle" type="button" data-toggle="dropdown">'.
          'foo <span class="caret"></span>'.
        '</button>';
    }

    return
      '<div class="foo btn-group' .$dropup. '" data-foo="bar">'.
        $btn.
        '<ul class="'.$right.'dropdown-menu">'.
          '<li ><a href="#">foo</a></li>'.
          '<li ><a href="#">bar</a></li>'.
        '</ul>'.
      '</div>';

  }

  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('normal'),
      array('primary'),
      array('danger'),
      array('warning'),
      array('success'),
      array('info'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->render();
    $matcher = $this->matcher();

    $this->assertEquals($matcher, $dropdown);
  }

  public function testSplitDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->split()->render();
    $matcher = $this->matcher('normal', false, false, true);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testRightDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->pull_right()->render();
    $matcher = $this->matcher('normal', true);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testRightSplitDropdown()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->pull_right()->split()->render();
    $matcher = $this->matcher('normal', true, false, true);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testDropup()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->dropup()->render();
    $matcher = $this->matcher('normal', false, true);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testDropupSplit()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->dropup()->split()->render();
    $matcher = $this->matcher('normal', false, true, true);

    $this->assertEquals($matcher, $dropdown);
  }

  /**
   * @dataProvider classes
   */
  public function testCallStatic($class)
  {
    $dropdown = DropdownButton::$class('foo', $this->links, $this->testAttributes)->render();
    $matcher = $this->matcher($class);

    $this->assertEquals($matcher, $dropdown);
  }

  public function testDynamicAttribute()
  {
    $dropdown = DropdownButton::normal('foo', $this->links, $this->testAttributes)->data_foo('bar')->class('foo')->render();
    $matcher = $this->matcher();

    $this->assertEquals($matcher, $dropdown);
  }

  public function testMultipleDropdowns()
  {
    $dropdowns =
      DropdownButton::normal('foo', $this->links, $this->testAttributes)->render().
      DropdownButton::normal('bar', $this->links, $this->testAttributes)->render();
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
