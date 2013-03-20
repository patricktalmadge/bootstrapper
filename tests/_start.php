<?php
ini_set('memory_limit', '1200M');

abstract class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  protected function setUp()
  {
    if (!class_exists('URL')) {
      Mockery::mock('alias:URL');
    }

    HtmlObject\Image::$urlGenerator = static::getURL();
    HtmlObject\Link::$urlGenerator = static::getURL();

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

  public static function getHTML()
  {
    return new LaravelBook\Laravel4Powerpack\HTML(static::getURL());
  }

  private static function getURL()
  {
    $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
    $url->shouldReceive('to')->andReturnUsing(function($to, $foo = array(), $https = false) {
      if ($to == '#' or starts_with($to, 'http://')) return $to;

      return 'http' .($https ? 's' : null). '://test/'.$to;
    });
    $url->shouldReceive('asset')->andReturnUsing(function($to, $foo = array(), $https = false) {
      if ($to == '#' or starts_with($to, 'http://')) return $to;

      return 'http' .($https ? 's' : null). '://test/'.$to;
    });

    return $url;
  }

  private static function getConfig($ignore = array())
  {
    if (class_exists('Config')) return false;

    $config = Mockery::mock('alias:Config');
    $config->shouldReceive('get')->with('bootstrapper::icons_prefix')->andReturn('icon-');
    $config->shouldReceive('get')->with('bootstrapper::breadcrumbs_separator')->andReturn('/');
    $config->shouldReceive('get')->with('bootstrapper::table.classes')->andReturn(array('striped', 'foo', 'hover'));
    $config->shouldReceive('get')->with('bootstrapper::table.ignore')->andReturn($ignore);

    return $config;
  }

  private static function getApp()
  {
    if (class_exists('App')) return false;

    $app = Mockery::mock('alias:App');
    $app->shouldReceive('make')->with('url')->andReturn(static::getURL());
    $app->shouldReceive('make')->with('form')->andReturn(new LaravelBook\Laravel4Powerpack\Form(static::getHTML()));

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
