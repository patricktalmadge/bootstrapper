<?php
Bundle::start('bootstrapper');
use Bootstrapper\Icons;

class IconsTest extends PHPUnit_Framework_TestCase
{
  private $baseIcon = array(
    'tag' => 'i',
    'attributes' => array(
      'class' => 'icon-folder-open'));

  public function testMake()
  {
    $icon = Icons::make('folder-open');
    $matcher = $this->baseIcon;

    $this->assertTag($matcher, $icon);
  }

  public function testMakeWithAttributes()
  {
    $icon = Icons::make(
      'folder-open',
       array('data-foo' => 'bar'));
    $matcher = $this->baseIcon;
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertTag($matcher, $icon);
  }

  public function testStatic()
  {
    $icon = Icons::folder_open();
    $matcher = $this->baseIcon;

    $this->assertTag($matcher, $icon);
  }

  public function testStaticWithAttributes()
  {
    $icon = Icons::folder_open(array('data-foo' => 'bar'));
    $matcher = $this->baseIcon;
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertTag($matcher, $icon);
  }

  public function testStaticWhiteWithAttributes()
  {
    $icon = Icons::white_folder_open(array('data-foo' => 'bar'));
    $matcher = $this->baseIcon;
    $matcher['attributes']['class'] .= ' icon-white';
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertTag($matcher, $icon);
  }
}
