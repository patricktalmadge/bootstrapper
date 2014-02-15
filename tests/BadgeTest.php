<?php
include_once '_start.php';

use Bootstrapper\Badge;

class BadgeTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    $class = ($class == 'normal') ? null : ' ' .$class;

    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'badge'.$class),
      'content' => 'foo',
    );
  }

  // Data providers  ----------------------------------------------- /

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
    $badge = Badge::custom('success', 'foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertHTML($match, $badge);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $badge = Badge::$class('foo', array('class' => 'bar'));
    $match = $this->createMatcher($class);

    $this->assertHTML($match, $badge);
  }
}
