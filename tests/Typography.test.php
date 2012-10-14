<?php
use Bootstrapper\Typography;

class TypographyTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    return array(
      'tag' => 'p',
      'attributes' => array('class' => $class),
      'content' => 'foo',
    );
  }

  private function createMatcher2($class)
  {
    return array(
      'tag' => 'div',
      'attributes' => array('class' => 'foo '.$class),
      'content' => 'foo',
    );
  }

  // Data providers ------------------------------------------------ /

  public function classes()
  {
    return array(
      array('muted', 'muted'),
      array('warning', 'text-warning'),
      array('error', 'text-error'),
      array('info', 'text-info'),
      array('success', 'text-success'),
    );
  }

  // Tests --------------------------------------------------------- /

  /**
   * @dataProvider classes
   */
  public function testEmphasis($method, $class)
  {
    $typography = Typography::$method('foo');
    $match = $this->createMatcher($class);

    $this->assertTag($match, $typography);
  }

  /**
   * @dataProvider classes
   */
  public function testEmphasisTag($method, $class)
  {
    $typography = Typography::$method('foo', 'div', $this->testAttributes);
    $match = $this->createMatcher2($class);

    $this->assertTag($match, $typography);
  }
}