<?php
use Bootstrapper\Tables;

class TablesTest extends BootstrapperWrapper
{

  // Matchers ------------------------------------------------------ /

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

  private $body = array(array('foo' => 'foo', 'bar' => 'bar', 'kal' => 'kal'));

  public function setUp()
  {
    Tables::open();
  }

  public function tearDown()
  {
    Tables::close();
  }

  // Tests --------------------------------------------------------- /

  public function testOpen()
  {
    $table = Tables::open($this->testAttributes);

    $this->assertTag($this->matcher, $table);
  }

  public function testStaticOpen()
  {
    $table = Tables::bordered_condensed_foobar_open($this->testAttributes);
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
    $headers = Tables::headers('foo', 'bar', 'tel', 'sub');
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

  public function testBody()
  {
    $body = Tables::body($this->body)->__toString();
    $matcher = '<tbody><tr><td class="column-foo">foo</td><td class="column-bar">bar</td><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testIgnore()
  {
    $body = Tables::body($this->body)->ignore('foo', 'bar')->__toString();
    $matcher = '<tbody><tr><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testDynamicColumn()
  {
    $body = Tables::body(array(array('foo' => 'bar')))->fur('var')->__toString();
    $matcher = '<tbody><tr><td class="column-foo">bar</td><td class="column-fur">var</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testReplaceColumns()
  {
    $body = Tables::body(array(array('foo' => 'foo')))->foo('bar')->__toString();
    $matcher = '<tbody><tr><td class="column-foo">bar</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testAlwaysIgnore()
  {
    Tables::always_ignore('foo', 'bar');

    $body = Tables::body($this->body)->__toString();
    $matcher = '<tbody><tr><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }
}