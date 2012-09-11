<?php
class BadgesTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    return array(
      'tag' => 'span',
      'attributes' => array('class' => 'bar badge badge-'.$class),
      'content' => 'foo',
    );
  }

  // Data providers  ----------------------------------------------- /

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
    $badge = Badges::custom('success', 'foo', array('class' => 'bar'));
    $match = $this->createMatcher('success');

    $this->assertTag($match, $badge);
  }

  /**
   * @dataProvider classes
   */
  public function testStatic($class)
  {
    $badge = call_user_func('Badges::'.$class, 'foo', array('class' => 'bar'));
    $match = $this->createMatcher($class);

    $this->assertTag($match, $badge);
  }
}