<?php
Bundle::start('bootstrapper');
use Bootstrapper\Badges;

class BadgesTest extends PHPUnit_Framework_TestCase
{
  private function createMatcher($class)
  {
    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'bar badge badge-'.$class),
      'content' => 'foo',
    );
  }

  public function testCustom()
  {
    $badge = Badges::custom('success', 'foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $badge);
  }

  public function testSuccess()
  {
    $badge = Badges::success('foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $badge);
  }

  public function testInverse()
  {
    $badge = Badges::inverse('foo', array('class' => 'bar'));
    $match = $this->createMatcher('inverse');

    $this->assertTag($match, $badge);
  }

  public function testImportant()
  {
    $badge = Badges::important('foo', array('class' => 'bar'));
    $match = $this->createMatcher('important');

    $this->assertTag($match, $badge);
  }

  public function testWarning()
  {
    $badge = Badges::warning('foo', array('class' => 'bar'));
    $match = $this->createMatcher('warning');

    $this->assertTag($match, $badge);
  }

  public function testInfo()
  {
    $badge = Badges::info('foo', array('class' => 'bar'));
    $match = $this->createMatcher('info');

    $this->assertTag($match, $badge);
  }
}