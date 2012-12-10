<?php
Bundle::start('bootstrapper');

abstract class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );

  /**
   * Uniformize test environment
   */
  public static function setUpBeforeClass()
  {
      URL::$base = 'http://test/';
      Config::set('application.languages', array());
      Config::set('application.index', '');
  }
}
