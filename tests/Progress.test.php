<?php
use Bootstrapper\Progress;

class ProgressTest extends BootstrapperWrapper
{
  private function matchProgress($class = 'normal', $width = 50)
  {
    $class = ($class == 'normal') ? null : ' progress-'.$class;

    return array(
      'tag' => 'div',
      'attributes' => array(
        'class'    => 'foo progress'.$class,
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
}