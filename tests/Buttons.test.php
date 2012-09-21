<?php
use Bootstrapper\Buttons;

class ButtonsTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    $class = (in_array($class, array('normal', 'submit', 'link', 'reset')))
      ? null : ' btn-'.$class;

    return array(
      'tag' => 'button',
      'attributes' => array(
        'type'     => 'button',
        'data-foo' => 'bar',
        'class'    => 'foo'.$class.' btn'),
      'content' => 'foo',
    );
  }

  private function createLink($class)
  {
    $link = $this->createMatcher($class);
    $link['tag'] = 'a';
    $link['attributes']['href'] = '#';

    return $link;
  }

  private function createSubmit($class)
  {
    $submit = $this->createMatcher($class);
    $submit['attributes']['type'] = 'submit';

    return $submit;
  }

  private function createReset($class)
  {
    $reset = $this->createMatcher($class);
    $reset['attributes']['type'] = 'reset';

    return $reset;
  }

  private function createIcon()
  {
    return array(
      'tag' => 'i',
      'attributes' => array(
        'class' => 'icon-folder-open'
      )
    );
  }

  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('normal'),
      array('custom'),
      array('error'),
      array('info'),
      array('inverse'),
      array('success'),
      array('warning'),
    );
  }

  /**
   * @dataProvider classes
   */
  public function testButton($class)
  {
    $button = Buttons::$class('foo', $this->testAttributes)->__toString();
    $matcher = $this->createMatcher($class);

    $this->assertTag($matcher, $button);
  }

  /**
   * @dataProvider classes
   */
  public function testLink($class)
  {
    if($class == 'normal') $class = 'link';
    $method = $class.'_link';

    $button = Buttons::$method('#', 'foo', $this->testAttributes)->__toString();
    $matcher = $this->createLink($class);

    $this->assertTag($matcher, $button);
  }

  /**
   * @dataProvider classes
   */
  public function testSubmit($class)
  {
    if($class == 'normal') $class = 'submit';
    $method = $class.'_submit';

    $button = Buttons::$method('foo', $this->testAttributes)->__toString();
    $matcher = $this->createSubmit($class);

    $this->assertTag($matcher, $button);
  }

  /**
   * @dataProvider classes
   */
  public function testReset($class)
  {
    if($class == 'normal') $class = 'reset';
    $method = $class.'_reset';

    $button = Buttons::$method('foo', $this->testAttributes)->__toString();
    $matcher = $this->createReset($class);

    $this->assertTag($matcher, $button);
  }

  public function testWithIcon()
  {
    $button1 = Buttons::info('foo', $this->testAttributes)->with_icon('folder_open')->__toString();
    $button2 = Buttons::info('foo', $this->testAttributes)->prepend_with_icon('folder_open')->__toString();
    $matcher = $this->createMatcher('info');
    $matcher['child'] = $this->createIcon();

    $this->assertTag($matcher, $button1);
    $this->assertTag($matcher, $button2);
  }

  public function testWithIconAppended()
  {
    $button = Buttons::info('foo', $this->testAttributes)->append_with_icon('folder_open')->__toString();
    $matcher = $this->createMatcher('info');
    $matcher['child'] = $this->createIcon();
    $exact =
    '<button class="foo btn-info btn" data-foo="bar" type="button">'.
      'foo <i class="icon-folder-open"></i>'.
    '</button>';

    $this->assertTag($matcher, $button);
    $this->assertEquals($exact, $button);
  }

  public function testDropDown()
  {
    $button = Buttons::info('foo', $this->testAttributes, true)->__toString();
    $matcher = $this->createMatcher('info');
    $exact =
      '<button class="foo btn-info btn dropdown-toggle" data-foo="bar" type="button" data-toggle="dropdown">'.
        'foo <span class="caret"></span>'.
      '</button>';

    $this->assertTag($matcher, $button);
    $this->assertEquals($exact, $button);
  }
}