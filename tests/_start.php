<?php
abstract class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  public static function setUpBeforeClass()
  {
    $url = static::getURL();
    $html = new Meido\HTML\HTML($url);

    Bootstrapper\HTML::construct($html);
  }

  protected function setUp()
  {
    if (!class_exists('URL')) {
      Mockery::mock('alias:URL');
    }

    static::getURL();
    static::getConfig();
    static::getApp();
    static::getRequest();
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// ILLUMINATE ////////////////////////////
  ////////////////////////////////////////////////////////////////////

  private static function getRequest()
  {
    if (class_exists('Request')) return false;

    $request = Mockery::mock('alias:Request');
    $request->shouldReceive('url')->andReturn('http://test/');

    return $request;
  }

  private static function getURL()
  {
    $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
    $url->shouldReceive('to')->andReturnUsing(function($to) {
      return $to == '#' ? '#' : 'http://test/'.$to;
    });

    return $url;
  }

  private static function getConfig()
  {
    if (class_exists('Config')) return false;

    $config = Mockery::mock('alias:Config');
    $config->shouldReceive('get')->with('bootstrapper::icons_prefix')->andReturn('icon-');

    return $config;
  }

  private static function getApp()
  {
    if (class_exists('App')) return false;

    $app = Mockery::mock('alias:App');
    $app->shouldReceive('make')->with('url')->andReturn(static::getURL());

    return $app;
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// ASSERTIONS ////////////////////////////
  ////////////////////////////////////////////////////////////////////

  public function assertHTML($matcher, $input)
  {
    $this->assertTag(
      $matcher,
      $input,
      "Failed asserting that the HTML matches the provided format :\n\t"
        .$input."\n\t"
        .json_encode($matcher));
  }
}
