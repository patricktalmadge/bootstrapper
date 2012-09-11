<?php
Bundle::start('bootstrapper');
use Bootstrapper\Labels;

class LabelsTest extends PHPUnit_Framework_TestCase
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'bar label label-'.$class),
      'content' => 'foo',
    );
  }

  // Data providers ------------------------------------------------ /

  public function classes()
  {
    return array(
      array('important'),
      array('info'),
      array('inverse'),
      array('success'),
      array('warning'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testCustom()
  {
    $label = Labels::custom('success', 'foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $label);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $label = call_user_func('Labels::'.$class, 'foo', array('class' => 'bar'));
    $match = $this->createMatcher($class);

    $this->assertTag($match, $label);
  }
}