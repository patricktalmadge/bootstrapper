<?php
include_once '_start.php';

use Bootstrapper\Label;

class LabelTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    $class = ($class == 'normal') ? ' label-default' : ' label-'.$class;

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
      array('primary'),
      array('success'),
      array('info'),
      array('danger'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testCustom()
  {
    $label = Label::custom('success', 'foo', $this->testAttributes);
    $match = $this->createMatcher('success');

    $this->assertHTML($match, $label);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $label = Label::$class('foo', $this->testAttributes);
    $match = $this->createMatcher($class);

    $this->assertHTML($match, $label);
  }
}
