<?php
use Bootstrapper\Config;

use \Config as LaravelConfig;

class ConfigTest extends BootstrapperWrapper
{
  public function setUp()
  {
    LaravelConfig::set('bootstrapper.foo', null);
    LaravelConfig::set('bootstrapper::bootstrapper.foo', null);
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
    LaravelConfig::set('bootstrapper.foo', 'bar');
    $config = Config::get('ter', 'fallback');

    $this->assertEquals('fallback', $config);
  }

  public function testUserCanSetEmptyConfigKeys()
  {
    LaravelConfig::set('bootstrapper.foo', '');
    $config = Config::get('foo');

    $this->assertEquals('', $config);
  }
}
