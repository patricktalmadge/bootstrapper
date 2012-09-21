<?php
use Bootstrapper\Tables;

class TablesTest extends BootstrapperWrapper
{
  private $matcher = array(
    'tag' => 'table',
    'attributes' => array(
      'data-foo' => 'bar',
      'class' => 'foo table'
    ),
  );

  private function matchFull($header = false)
  {
    return array(
      'tag' => 'tr',
      'attributes' => array(
        'class' => 'foo full-row',
        'data-foo' => 'bar',
      ),
      'child' => array(
        'tag' => $header ? 'th' : 'td',
        'attributes' => array('colspan' => 4),
        'content' => 'foo',
      ),
    );
  }

  public function testOpen()
  {
    $table = Tables::open($this->testAttributes);

    $this->assertTag($this->matcher, $table);
  }

  public function testStaticOpen()
  {
    $table = Tables::bordered_condensed_foobar($this->testAttributes);
    $matcher = $this->matcher;
    $matcher['attributes']['class'] = 'foo table-bordered table-condensed table';

    $this->assertTag($matcher, $table);
  }

  public function testClose()
  {
    $close = Tables::close();

    $this->assertEquals('</table>', $close);
  }

  public function testHeadersSimple()
  {
    $headers = Tables::headers(array('foo', 'bar', 'tel', 'sub'));
    $headers = str_replace(PHP_EOL, null, $headers);

    $matcher =
    '<thead>'.
      '<th>foo</th>'.
      '<th>bar</th>'.
      '<th>tel</th>'.
      '<th>sub</th>'.
    '</thead>';

    $this->assertEquals($matcher, $headers);
  }

  public function testHeadersComplex()
  {
    $headers = Tables::headers(array(
      'foo' => $this->testAttributes,
      'bar' => $this->testAttributes));
    $headers = str_replace(PHP_EOL, null, $headers);

    $matcher =
    '<thead>'.
      '<th class="foo" data-foo="bar">foo</th>'.
      '<th class="foo" data-foo="bar">bar</th>'.
    '</thead>';

    $this->assertEquals($matcher, $headers);
  }

  public function testFullRow()
  {
    Tables::headers('foo', 'foo', 'foo', 'foo');
    $fullRow = Tables::full_row('foo', $this->testAttributes);
    $matcher = $this->matchFull();

    $this->assertTag($matcher, $fullRow);
  }

  public function testFullHeader()
  {
    Tables::headers('foo', 'foo', 'foo', 'foo');
    $fullRow = Tables::full_header('foo', $this->testAttributes);
    $matcher = $this->matchFull(true);

    $this->assertTag($matcher, $fullRow);
  }
}