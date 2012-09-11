<?php
Bundle::start('bootstrapper');
use Bootstrapper\Breadcrumbs;

class BreadcrumbsTest extends PHPUnit_Framework_TestCase
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
      'data-foo' => 'bar',
      'class' => 'foo breadcrumb',
    ),
  );

  public function testCreate()
  {
    $breadcrumbs = Breadcrumbs::create($this->crumbs, array('data-foo' => 'bar', 'class' => 'foo'));

    $this->assertTag($this->matcher, $breadcrumbs);
  }

  public function testChangeSeparator()
  {
    Breadcrumbs::$separator = '__';
    $breadcrumbs = Breadcrumbs::create($this->crumbs, array('data-foo' => 'bar', 'class' => 'foo'));

    $matcher = $this->matcher;
    $matcher['children']['only']['descendant']['content'] = '__';

    $this->assertTag($matcher, $breadcrumbs);
  }
}