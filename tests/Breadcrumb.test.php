<?php
use Bootstrapper\Breadcrumb;

class BreadcrumbTest extends BootstrapperWrapper
{
  private $crumbs = array(
    'foo' => 'bar',
    'kal' => 'tom',
    'sat' => 'ven',
  );

  private $matcher = array(
    'tag' => 'ul',
    'children' => array(
      'count' => 3,
      'only' => array(
        'tag' => 'li',
        'descendant' => array(
          'tag' => 'span',
          'attributes' => array('class' => 'divider'),
          'content' => '/',
        ),
      ),
    ),
    'attributes' => array(
      'class'    => 'foo breadcrumb',
      'data-foo' => 'bar',
    ),
  );

  public function testCreate()
  {
    $breadcrumb = Breadcrumb::create($this->crumbs, $this->testAttributes);

    $this->assertTag($this->matcher, $breadcrumb);
  }

  public function testChangeSeparator()
  {
    Breadcrumb::$separator = '__';
    $breadcrumb = Breadcrumb::create($this->crumbs, $this->testAttributes);

    $matcher = $this->matcher;
    $matcher['children']['only']['descendant']['content'] = '__';

    $this->assertTag($matcher, $breadcrumb);
  }
}
