<?php
Bundle::start('bootstrapper');
use Bootstrapper\ButtonToolbar;

class ButtonToolbarTest extends PHPUnit_Framework_TestCase
{
  public function testOpen()
  {
    $open = ButtonToolbar::open(array('class' => 'foo', 'data-foo' => 'bar'));
    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class'    => 'foo btn-toolbar',
        'data-foo' => 'bar',
      ),
    );

    $this->assertTag($matcher, $open);
  }

  public function testClose()
  {
    $close = ButtonToolbar::close();

    $this->assertEquals('</div>', $close);
  }
}