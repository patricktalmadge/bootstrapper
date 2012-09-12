<?php
include 'start.php';
use Bootstrapper\Alert;

class AlertTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
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
    $alert = Alert::custom('success', 'foo', true, $this->testAttributes);
    $match = $this->createMatcher('success');

    $this->assertTag($match, $alert);
  }

  public function testCustomWithoutClose()
  {
    $alert = Alert::custom('success', 'foo', false, $this->testAttributes);
    $match = array(
      'attributes' => array('data-foo' => 'bar', 'class' => 'foo alert alert-success'),
      'content'    => 'foo',
      'tag'        => 'div',
    );

    $this->assertTag($match, $alert);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $alert = Alert::$class('foo', true, $this->testAttributes);
    $match = $this->createMatcher($class);

    $this->assertTag($match, $alert);
  }
}