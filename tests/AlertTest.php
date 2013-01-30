<?php
include '_start.php';

use Bootstrapper\Alert;

class AlertTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class, $close = true)
  {
    if ($close) {
      return array(
        'tag' => 'div',
        'attributes' => array(
          'data-foo' => 'bar',
          'class' => 'foo alert alert-'.$class),
        'content' => 'foo',
        'child' => array(
          'tag' => 'a',
          'attributes' => array(
            'class' => 'close',
            'data-dismiss' => 'alert',
            'href' => '#',
          ),
        ),
      );
    } else {
      return array(
        'tag' => 'div',
        'attributes' => array(
          'data-foo' => 'bar',
          'class' => 'foo alert alert-'.$class),
        'content' => 'foo',
      );
    }
  }

  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('danger'),
      array('error'),
      array('info'),
      array('success'),
      array('warning'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testCustom()
  {
    $alert = Alert::custom('success', 'foo', $this->testAttributes);
    $match = $this->createMatcher('success');

    $this->assertHTML($match, $alert);
  }

  public function testCustomWithoutClose()
  {
    $alert = Alert::custom('success', 'foo', $this->testAttributes)->open();
    $match = array(
      'attributes' => array('data-foo' => 'bar', 'class' => 'foo alert alert-success'),
      'content'    => 'foo',
      'tag'        => 'div',
    );

    $this->assertHTML($match, $alert);
  }

  public function testStaticOpened()
  {
    $alert = Alert::open_success('foo', $this->testAttributes);
    $match = $this->createMatcher('success', false);

    $this->assertHTML($match, $alert);
  }

  public function testStaticOpenBlock()
  {
    $alert = Alert::open_block_success('foo', $this->testAttributes);
    $match = $this->createMatcher('success', false);
    $match['attributes']['class'] .= ' alert-block';

    $this->assertHTML($match, $alert);
  }

  public function testStaticWhatever()
  {
    $alert = Alert::foo_bar('foo', $this->testAttributes);
    $match = $this->createMatcher('foo-bar');

    $this->assertHTML($match, $alert);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $alert = Alert::$class('foo', $this->testAttributes);
    $match = $this->createMatcher($class);

    $this->assertHTML($match, $alert);
  }
}
