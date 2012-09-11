<?php
Bundle::start('bootstrapper');
use Bootstrapper\ButtonGroup;

class ButtonGroupTest extends PHPUnit_Framework_TestCase
{
  private $buttonGroup = array(
    'tag' => 'div',
    'attributes' => array(
      'data-foo' => 'bar',
      'class'    => 'btn-group',
    ),
  );

  public function testOpen()
  {
    $open = ButtonGroup::open(false, array('data-foo' => 'bar'));
    $matcher = $this->buttonGroup;

    $this->assertTag($matcher, $open);
  }

  public function OpenToggle()
  {
    $open = ButtonGroup::open(true, array('data-foo' => 'bar'));
    $matcher = $this->buttonGroup;
    $matcher['attributes']['data-toggle'] = 'buttons-1';

    $this->assertTag($matcher, $open);
  }

  public function testHorizontalOpenCheckbox()
  {
    $open = ButtonGroup::horizontal_open('checkbox', array('data-foo' => 'bar'));
    $equals = ButtonGroup::open('checkbox', array('data-foo' => 'bar'));
    $matcher = $this->buttonGroup;
    $matcher['attributes']['data-toggle'] = 'buttons-checkbox';

    $this->assertTag($matcher, $open);
    $this->assertEquals($equals, $open);
  }

  public function testVerticalOpenRadio()
  {
    $open = ButtonGroup::vertical_open('radio', array('data-foo' => 'bar'));
    $matcher = $this->buttonGroup;
    $matcher['attributes']['class'] = 'btn-group-vertical '.$matcher['attributes']['class'];
    $matcher['attributes']['data-toggle'] = 'buttons-radio';

    $this->assertTag($matcher, $open);
  }
}