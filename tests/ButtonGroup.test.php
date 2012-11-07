<?php
use Bootstrapper\ButtonGroup;

class ButtonGroupTest extends BootstrapperWrapper
{
  private $buttonGroup = array(
    'tag' => 'div',
    'attributes' => array(
      'data-foo' => 'bar',
      'class'    => 'foo btn-group',
    ),
  );

  public function testOpen()
  {
    $open = ButtonGroup::open(false, $this->testAttributes);

    $this->assertTag($this->buttonGroup, $open);
  }

  public function testClose()
  {
    $this->assertEquals('</div>', ButtonGroup::close());
  }

  public function OpenToggle()
  {
    $open = ButtonGroup::open(true, $this->testAttributes);
    $matcher = $this->buttonGroup;
    $matcher['attributes']['data-toggle'] = 'buttons-1';

    $this->assertTag($matcher, $open);
  }

  public function testHorizontalOpenCheckbox()
  {
    $open = ButtonGroup::horizontal_open('checkbox', $this->testAttributes);

    $equals = ButtonGroup::open('checkbox', $this->testAttributes);
    $matcher = $this->buttonGroup;
    $matcher['attributes']['data-toggle'] = 'buttons-checkbox';

    $this->assertTag($matcher, $open);
    $this->assertEquals($equals, $open);
  }

  public function testVerticalOpenRadio()
  {
    $open = ButtonGroup::vertical_open('radio', $this->testAttributes);

    $matcher = $this->buttonGroup;
    $matcher['attributes']['class'] = 'btn-group-vertical '.$matcher['attributes']['class'];
    $matcher['attributes']['data-toggle'] = 'buttons-radio';

    $this->assertTag($matcher, $open);
  }
}
