<?php
include_once '_start.php';

use Bootstrapper\Helpers;
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
      'class'    => 'glyphicon-folder-open',
  ));

  /**
   * Matcher for the icon with attributes
   * @var array
   */
  private $baseIconWithAttributes = array(
    'tag' => 'i',
    'attributes' => array(
      'class'    => 'foo glyphicon-folder-open',
      'data-foo' => 'bar',
  ));

  // Tests --------------------------------------------------------- /

  public function testMake()
  {
    $icon = Icon::make($this->testIcon);

    $this->assertHTML($this->baseIcon, $icon);
  }

  public function testMakeWithAttributes()
  {
    $icon = Icon::make($this->testIcon, $this->testAttributes);

    $this->assertHTML($this->baseIconWithAttributes, $icon);
  }

  public function testStatic()
  {
    $icon = Icon::folder_open();

    $this->assertHTML($this->baseIcon, $icon);
  }

  public function testStaticWithAttributes()
  {
    $icon = Icon::folder_open($this->testAttributes);

    $this->assertHTML($this->baseIconWithAttributes, $icon);
  }

  public function testStaticWhiteWithAttributes()
  {
    $icon = Icon::white_folder_open($this->testAttributes);

    $matcher = $this->baseIcon;
    $matcher['attributes']['class']   .= ' glyphicon-white';
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertHTML($matcher, $icon);
  }
}
