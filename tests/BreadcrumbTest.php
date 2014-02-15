<?php
include_once '_start.php';

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

    $this->assertHTML($this->matcher, $breadcrumb);
  }
}
