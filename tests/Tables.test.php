<?php
use Bootstrapper\Tables;

class TablesTest extends BootstrapperWrapper
{
  public function testOpen()
  {
    $table = Tables::open();
    $matcher = array('tag' => 'table', 'attributes' => array('class' => 'table'));

    $this->assertTag($matcher, $table);
  }
}