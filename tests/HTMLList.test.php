<?php
use Bootstrapper\HTMLList;

class HTMLListTest extends BootstrapperWrapper
{
  private $list = array(
    'foo' => 'bar',
    'far' => 'bur'
  );

  private $matcher = array(
    'tag' => 'dl',
    'children' => array('count' => 4),
    'attributes' => array(
      'class' => 'foo',
      'data-foo' => 'bar',
    ),
  );

  public function testDl()
  {
    $dl = HTMLList::dl($this->list, $this->testAttributes);
    $matcher = $this->matcher;

    $this->assertTag($matcher, $dl);
  }

  public function testHorizontalDl()
  {
    $dl = HTMLList::horizontal_dl($this->list, $this->testAttributes);
    $matcher = $this->matcher;
    $matcher['attributes']['class'] = 'foo dl-horizontal';

    $this->assertTag($matcher, $dl);
  }
}