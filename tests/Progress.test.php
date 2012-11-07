<?php
use Bootstrapper\Progress;

class ProgressTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function matchProgress($type = 'normal', $width = 50, $striped = false, $active = false)
  {
    $class = 'foo';

    if($striped) $class .= ' progress-striped';
    if($active) $class .= ' active ';
    $class .= ' progress';
    if($type != 'normal') $class .= ' progress-'.$type;

    return array(
      'tag' => 'div',
      'attributes' => array(
        'class'    => $class,
        'data-foo' => 'bar',
      ),
      'child' => array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'bar',
          'style' => 'width: ' .$width. '%;'
        ),
      ),
    );
  }

  // Data providers ------------------------------------------------ /

  public function provideBars()
  {
    return array(
      array('normal'),
      array('success'),
      array('info'),
      array('warning'),
      array('danger'),
    );
  }

  // Tests --------------------------------------------------------- /

  /**
   * @dataProvider provideBars
   */
  public function testSimple($class)
  {
    $progress = Progress::$class(50, $this->testAttributes);
    $matcher = $this->matchProgress($class);

    $this->assertTag($matcher, $progress);
  }

  public function testStacked()
  {
    $progress = Progress::danger(
      array(25 => 'success', 50 => 'error', 10 => 'warning'),
      $this->testAttributes
    );

    // Build more complex matcher
    $matcher = $this->matchProgress();
    $matcher['attributes']['class'] = 'foo progress';
    $matcher['child']['attributes']['class'] = 'bar bar-error';
    $matcher['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'bar bar-success',
        'style' => 'width: 25%;'
      ),
    );
    $matcher['children'] = array(
      'count' => 3,
      'only' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'bar'),
      ),
    );

    $this->assertTag($matcher, $progress);
  }

  public function testFloat()
  {
    $progress = Progress::success(5.40, $this->testAttributes);
    $matcher = $this->matchProgress('success', 5);

    $this->assertTag($matcher, $progress);
  }

  public function testAutomatic()
  {
    $classes = array(
      0   => 'danger',
      20  => 'danger',
      40  => 'warning',
      60  => 'info',
      80  => 'success',
      100 => 'success');

    for ($i = 0; $i <= 100; $i = $i + 20) {
      $progress = Progress::automatic($i, $this->testAttributes);
      $matcher = $this->matchProgress($classes[$i], $i);

      $this->assertTag($matcher, $progress);
    }
  }

  public function testStriped()
  {
    $progress = Progress::striped_info(50, $this->testAttributes);
    $matcher = $this->matchProgress('info', 50, true);

    $this->assertTag($matcher, $progress);
  }

  public function testActive()
  {
    $progress = Progress::active_info(50, $this->testAttributes);
    $matcher = $this->matchProgress('info', 50, false, true);

    $this->assertTag($matcher, $progress);
  }

  public function testActiveStriped()
  {
    $progress = Progress::striped_active_info(50, $this->testAttributes);
    $matcher = $this->matchProgress('info', 50, true, true);

    $this->assertTag($matcher, $progress);
  }

  public function testExceptionAttributes()
  {
    $this->setExpectedException('InvalidArgumentException');

    $progress = Progress::striped_normal(50, 'foo');
  }
}
