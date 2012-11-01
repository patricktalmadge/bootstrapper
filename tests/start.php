<?php
Bundle::start('bootstrapper');

class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  public function testSomething()
  {
    $this->assertTrue(true);
  }
}