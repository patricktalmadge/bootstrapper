<?php
Bundle::start('bootstrapper');

abstract class BootstrapperWrapper extends PHPUnit_Framework_TestCase
{
  protected $testAttributes = array(
    'class'    => 'foo',
    'data-foo' => 'bar',
  );
}