<?php
use Bootstrapper\Icon;

class IconTest extends BootstrapperWrapper
{
  /**
   * The icon we'll test with (the most complex one)
   * @var string
   */
  private $testIcon = 'folder-open';

  /**
   * Matcher for the icon
   * @var array
   */
  private $baseIcon = array(
    'tag' => 'i',
    'attributes' => array(
      'class'    => 'icon-folder-open',
  ));

  /**
   * Matcher for the icon with attributes
   * @var array
   */
  private $baseIconWithAttributes = array(
    'tag' => 'i',
    'attributes' => array(
      'class'    => 'foo icon-folder-open',
      'data-foo' => 'bar',
  ));

  // Tests --------------------------------------------------------- /

  public function testMake()
  {
    $icon = Icon::make($this->testIcon);

    $this->assertTag($this->baseIcon, $icon);
  }

  public function testMakeWithAttributes()
  {
    $icon = Icon::make($this->testIcon, $this->testAttributes);

    $this->assertTag($this->baseIconWithAttributes, $icon);
  }

  public function testStatic()
  {
    $icon = Icon::folder_open();

    $this->assertTag($this->baseIcon, $icon);
  }

  public function testStaticWithAttributes()
  {
    $icon = Icon::folder_open($this->testAttributes);

    $this->assertTag($this->baseIconWithAttributes, $icon);
  }

  public function testStaticWhiteWithAttributes()
  {
    $icon = Icon::white_folder_open($this->testAttributes);

    $matcher = $this->baseIcon;
    $matcher['attributes']['class']   .= ' icon-white';
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertTag($matcher, $icon);
  }
}
