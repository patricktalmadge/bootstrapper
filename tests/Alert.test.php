<?php
Bundle::start('bootstrapper');
use Bootstrapper\Alert;

class AlertTest extends PHPUnit_Framework_TestCase
{
  private function createMatcher($class)
  {
    return array(
      'tag' => 'div',
      'attributes' => array('class' => 'bar alert alert-'.$class),
      'child' => array(
        'tag' => 'a',
        'attributes' => array(
          'class' => 'close',
          'data-dismiss' => 'alert',
          'href' => '#',
        ),
      ),
      'content' => 'foo',
    );
  }

  public function testCustom()
  {
    $alert = Alert::custom('success', 'foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $alert);
  }

  public function testCustomWithoutClose()
  {
    $alert = Alert::custom('success', 'foo', false, array('class' => 'bar'));
    $match = array(
      'attributes' => array('class' => 'bar alert alert-success'),
      'content'    => 'foo',
      'tag'        => 'div',
    );

    $this->assertTag($match, $alert);
  }

  public function testSuccess()
  {
    $alert = Alert::success('foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $alert);
  }

  public function testError()
  {
    $alert = Alert::error('foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('error');

    $this->assertTag($match, $alert);
  }

  public function testDanger()
  {
    $alert = Alert::danger('foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('danger');

    $this->assertTag($match, $alert);
  }

  public function testWarning()
  {
    $alert = Alert::warning('foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('warning');

    $this->assertTag($match, $alert);
  }

  public function testInfo()
  {
    $alert = Alert::info('foo', true, array('class' => 'bar'));
    $match = $this->createMatcher('info');

    $this->assertTag($match, $alert);
  }
}