<?php
Bundle::start('bootstrapper');
use Bootstrapper\Labels;

class LabelsTest extends PHPUnit_Framework_TestCase
{
  private function createMatcher($class)
  {
    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'bar label label-'.$class),
      'content' => 'foo',
    );
  }

  public function testCustom()
  {
    $label = Labels::custom('success', 'foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $label);
  }

  public function testSuccess()
  {
    $label = Labels::success('foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $label);
  }

  public function testInverse()
  {
    $label = Labels::inverse('foo', array('class' => 'bar'));
    $match = $this->createMatcher('inverse');

    $this->assertTag($match, $label);
  }

  public function testImportant()
  {
    $label = Labels::important('foo', array('class' => 'bar'));
    $match = $this->createMatcher('important');

    $this->assertTag($match, $label);
  }

  public function testWarning()
  {
    $label = Labels::warning('foo', array('class' => 'bar'));
    $match = $this->createMatcher('warning');

    $this->assertTag($match, $label);
  }

  public function testInfo()
  {
    $label = Labels::info('foo', array('class' => 'bar'));
    $match = $this->createMatcher('info');

    $this->assertTag($match, $label);
  }
}