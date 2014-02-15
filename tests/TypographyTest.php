<?php
include_once '_start.php';

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
      array('muted', 'text-muted'),
      array('lead', 'lead'),
      array('warning', 'text-warning'),
      array('error', 'text-danger'),
      array('info', 'text-info'),
      array('success', 'text-success'),
      array('danger', 'text-danger'),
      array('primary', 'text-primary'),
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

    $this->assertHTML($match, $typography);
  }

  /**
   * @dataProvider classes
   */
  public function testEmphasisTag($method, $class)
  {
    $typography = Typography::$method('foo', 'div', $this->testAttributes);
    $match = $this->createMatcher2($class);

    $this->assertHTML($match, $typography);
  }

  private $list = array(
    'foo' => 'bar',
    'far' => 'bur'
  );

  private $listMatcher = array(
    'tag' => 'dl',
    'children' => array('count' => 4),
    'attributes' => array(
      'class' => 'foo',
      'data-foo' => 'bar',
    ),
  );

  public function testDl()
  {
    $dl = Typography::dl($this->list, $this->testAttributes);
    $matcher = $this->listMatcher;

    $this->assertHTML($matcher, $dl);
  }

  public function testHorizontalDl()
  {
    $dl = Typography::horizontal_dl($this->list, $this->testAttributes);
    $matcher = $this->listMatcher;
    $matcher['attributes']['class'] = 'foo dl-horizontal';

    $this->assertHTML($matcher, $dl);
  }
}
