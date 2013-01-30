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

    $this->assertHTML($this->buttonGroup, $open);
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

    $this->assertHTML($matcher, $open);
  }

  public function testHorizontalOpenCheckbox()
  {
    $open = ButtonGroup::horizontal_open('checkbox', $this->testAttributes);

    $equals = ButtonGroup::open('checkbox', $this->testAttributes);
    $matcher = $this->buttonGroup;
    $matcher['attributes']['data-toggle'] = 'buttons-checkbox';

    $this->assertHTML($matcher, $open);
    $this->assertEquals($equals, $open);
  }

  public function testVerticalOpenRadio()
  {
    $open = ButtonGroup::vertical_open('radio', $this->testAttributes);

    $matcher = $this->buttonGroup;
    $matcher['attributes']['class'] = 'btn-group-vertical '.$matcher['attributes']['class'];
    $matcher['attributes']['data-toggle'] = 'buttons-radio';

    $this->assertHTML($matcher, $open);
  }
}
