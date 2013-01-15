<?php
abstract class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  public static function startUpBeforeClass()
  {
    $url = Mockery\Mockery::mock('UrlGenerator');

    $app = Mockery\Mockery::mock('alias:App');
    $app->shouldReceive('make')->with('url')->andReturn($url);
  }
}
