<?php
include_once '_start.php';

use Bootstrapper\ButtonGroup;

class ButtonGroupTest extends BootstrapperWrapper
{
  private function getMatcher($class, $type) {
    return array(
      'tag' => 'div',
      'attributes' => array(
        'data-foo' => 'bar',
        'class'    => 'foo btn-group',
        'data-toggle' => 'buttons'
      ),
      'children' => array(
        'count' => 3,
        'only' => array(
          'tag' => 'label',
          'attributes' => array(
            'class' => 'btn ' . $class,
          ),
          'child' => array(
            'tag' => 'input',
            'attributes' => array(
              'type' => $type,
            )
          )
        )
      )
    );
  }

  public function types() {
    return array(
      array('radio'),
      array('checkbox')
    );
  }

  public function classes() {
    return array(
      array(ButtonGroup::NORMAL),
      array(ButtonGroup::PRIMARY),
      array(ButtonGroup::SUCCESS),
      array(ButtonGroup::INFO),
      array(ButtonGroup::DANGER),
      array(ButtonGroup::LINK),
    );
  }

  /**
   * @dataProvider types
   */
  public function testMethods($type) {
    $html = ButtonGroup::$type(array(
      array(ButtonGroup::PRIMARY, 'Option 1'),
      array(ButtonGroup::PRIMARY, 'Option 2'),
      array(ButtonGroup::PRIMARY, 'Option 3'),
    ), $this->testAttributes);

    $matcher = $this->getMatcher('btn-primary', $type);

    $this->assertHTML($matcher, $html);
  }

  /**
   * @dataProvider classes
   */
  public function testClasses($class) {
    $html = ButtonGroup::radio(array(
      array($class, 'Option 1'),
      array($class, 'Option 2'),
      array($class, 'Option 3'),
    ), $this->testAttributes);

    $matcher = $this->getMatcher($class, 'radio');

    $this->assertHTML($matcher, $html);
  }

}
