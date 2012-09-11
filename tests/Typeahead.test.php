<?php
Bundle::start('bootstrapper');
use Bootstrapper\Typeahead;

class TypeaheadTest extends PHPUnit_Framework_TestCase
{
  private $items = array(
    'Lorem',
    'Ipsum',
    'Dolor'
  );

  public function testCreate()
  {
    $typeahead = Typeahead::create($this->items, 8, array('data-foo' => 'bar'));
    $matcher = array(
      'tag' => 'input',
      'attributes' => array(
        'data-foo'     => 'bar',
        'data-items'   => 8,
        'data-provide' => 'typeahead',
        'data-source'  => '["Lorem","Ipsum","Dolor"]',
        'type'         => 'text',
      ),
    );

    $this->assertTag($matcher, $typeahead);
  }
}