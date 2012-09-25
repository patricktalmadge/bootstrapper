<?php
use Bootstrapper\Labels;

class LabelsTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    $class = ($class == 'normal') ? null : ' label-'.$class;

    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'foo label'.$class),
      'content' => 'foo',
    );
  }

  // Data providers ------------------------------------------------ /

  public function classes()
  {
    return array(
      array('normal'),
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
    $label = Labels::custom('success', 'foo', $this->testAttributes);
    $match = $this->createMatcher('success');

    $this->assertTag($match, $label);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $label = Labels::$class('foo', $this->testAttributes);
    $match = $this->createMatcher($class);

    $this->assertTag($match, $label);
  }
}