<?php
include_once '_start.php';

use Bootstrapper\ButtonToolbar;

class ButtonToolbarTest extends BootstrapperWrapper
{
  public function testOpen()
  {
    $open = ButtonToolbar::open($this->testAttributes);
    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class'    => 'foo btn-toolbar',
        'data-foo' => 'bar',
      ),
    );

    $this->assertHTML($matcher, $open);
  }

  public function testClose()
  {
    $close = ButtonToolbar::close();

    $this->assertEquals('</div>', $close);
  }
}
