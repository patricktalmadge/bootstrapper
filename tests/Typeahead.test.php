<?php
use Bootstrapper\Typeahead;

class TypeaheadTest extends BootstrapperWrapper
{
  private $items = array(
    'Lorem',
    'Ipsum',
    'Dolor'
  );

  public function testCreate()
  {
    $typeahead = Typeahead::create($this->items, 8, $this->testAttributes);
    $matcher = array(
      'tag' => 'input',
      'attributes' => array(
        'class'        => 'foo',
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
