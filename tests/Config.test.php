<?php
use Bootstrapper\Config;

use \Config as LaravelConfig;

class ConfigTest extends BootstrapperWrapper
{
  public function setUp()
  {
    LaravelConfig::set('bootstrapper', array());
    LaravelConfig::set('bootstrapper::bootstrapper', array());
  }

  public function testCanSetCustomValues()
  {
    Config::set('foo', 'bar');
    $config = Config::get('foo');

    $this->assertEquals('bar', $config);
  }

  public function testCanGetValuesFromUserConfig()
  {
    LaravelConfig::set('bootstrapper.foo', 'bar');
    $config = Config::get('foo');

    $this->assertEquals('bar', $config);
  }

  public function testCanProvideAFallback()
  {
    LaravelConfig::set('bootstrapper.ter', 'bar');
    $config = Config::get('foo', 'fallback');

    $this->assertEquals('fallback', $config);
  }
}