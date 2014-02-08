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
    HtmlObject\Link::$urlGenerator  = static::getURL();

    static::getURL();
    static::getApp();
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// ILLUMINATE ////////////////////////////
  ////////////////////////////////////////////////////////////////////

  private static function getApp()
  {
    $app = Mockery::mock('Illuminate\Container\Container');
    $app->shouldReceive('make')->with('url')->andReturn(static::getURL());
    $app->shouldReceive('make')->with('html')->andReturn(static::getHTML());
    $app->shouldReceive('make')->with('request')->andReturn(static::getRequest());
    $app->shouldReceive('make')->with('form')->andReturn(static::getForm());
    $app->shouldReceive('make')->with('config')->andReturn(static::getConfig());

    Bootstrapper\Helpers::setContainer($app);
  }

  private static function getRequest()
  {
    $request = Mockery::mock('Request');
    $request->shouldReceive('url')->andReturn('http://test/');

    return $request;
  }

  public static function getHTML()
  {
    return new Illuminate\Html\HtmlBuilder(static::getURL());
  }

  public static function getForm()
  {
    return new Illuminate\Html\FormBuilder(static::getHTML(), static::getUrl(), 'foo');
  }

  private static function getURL()
  {
    $url = Mockery::mock('Illuminate\Routing\UrlGenerator');
    $url->shouldReceive('to')->andReturnUsing(function($to, $foo = array(), $https = false) {
      if ($to == '#' or starts_with($to, 'http://')) return $to;
      return 'http' .($https ? 's' : null). '://test/'.$to;
    });
    $url->shouldReceive('action')->andReturnUsing(function($to, $foo = array(), $https = false) {
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
    $config = Mockery::mock('Config');
    $config->shouldReceive('get')->with('bootstrapper::icons_prefix')->andReturn('icon-');
    $config->shouldReceive('get')->with('bootstrapper::breadcrumbs_separator')->andReturn('/');
    $config->shouldReceive('get')->with('bootstrapper::table.classes')->andReturn(array('striped', 'foo', 'hover'));
    $config->shouldReceive('get')->with('bootstrapper::table.ignore')->andReturn($ignore);
    $config->shouldReceive('get')->with('bootstrapper::icon_prefix')->andReturn("glyphicon-");
    $config->shouldReceive('get')->with('bootstrapper::bootstrap_version')->andReturn('3.1.0');
    $config->shouldReceive('get')->with('bootstrapper::jquery_version')->andReturn('2.1.0');
    
    return $config;
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// ASSERTIONS ////////////////////////////
  ////////////////////////////////////////////////////////////////////

  public function assertHTML($matcher, $input)
  {
    if (is_object($input)) {
      $input = $input->render();
    }

    $this->assertTag($matcher, $input, "Failed asserting that the HTML matches the provided format :\n\t".$input."\n\t".json_encode($matcher));
  }
}
