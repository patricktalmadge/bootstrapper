<?php
include_once '_start.php';

use Bootstrapper\Config;
use Bootstrapper\Table;

class TableTest extends BootstrapperWrapper
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
    parent::setUp();

    Table::open();
  }

  public function tearDown()
  {
    parent::tearDown();

    Table::close();
  }

  // Tests --------------------------------------------------------- /

  public function testOpen()
  {
    $table = Table::open($this->testAttributes);

    $this->assertHTML($this->matcher, $table);
  }

  public function testDefaultOpen()
  {
    $table = Table::open();

    $this->assertEquals('<table class="table-striped table-hover table">', $table);
  }

  public function testStaticOpen()
  {
    $table = Table::bordered_condensed_foobar_open($this->testAttributes);
    $matcher = $this->matcher;
    $matcher['attributes']['class'] = 'foo table-bordered table-condensed table';

    $this->assertHTML($matcher, $table);
  }

  public function testClose()
  {
    $close = Table::close();

    $this->assertEquals('</table>', $close);
  }

  public function testHeadersSimple()
  {
    $headers = Table::headers('foo', 'bar', 'tel', 'sub');
    $headers = str_replace(PHP_EOL, null, $headers);

    $matcher =
    '<thead>'.
              '<tr>' .
              '<th>foo</th>'.
              '<th>bar</th>'.
              '<th>tel</th>'.
              '<th>sub</th>'.
              '</tr>' .
              '</thead>';

    $this->assertEquals($matcher, $headers);
  }

  public function testHeadersComplex()
  {
    $headers = Table::headers(array(
      'foo' => $this->testAttributes,
      'bar' => $this->testAttributes));
    $headers = str_replace(PHP_EOL, null, $headers);

    $matcher =
    '<thead>'.
              '<tr>'.
              '<th class="foo" data-foo="bar">foo</th>'.
              '<th class="foo" data-foo="bar">bar</th>'.
              '</tr>'.
              '</thead>';

    $this->assertEquals($matcher, $headers);
  }

  public function testFullRow()
  {
    Table::headers('foo', 'foo', 'foo', 'foo');
    $fullRow = Table::full_row('foo', $this->testAttributes);
    $matcher = $this->matchFull();

    $this->assertHTML($matcher, $fullRow);
  }

  public function testFullHeader()
  {
    Table::headers('foo', 'foo', 'foo', 'foo');
    $fullRow = Table::full_header('foo', $this->testAttributes);
    $matcher = $this->matchFull(true);

    $this->assertHTML($matcher, $fullRow);
  }

  public function testEmptyBody()
  {
    $body = Table::body(array())->__toString();
    $this->assertSame('', $body);
  }

  public function testBody()
  {
    $body = Table::body($this->body)->__toString();
    $matcher = '<tbody><tr><td class="column-foo">foo</td><td class="column-bar">bar</td><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testIgnore()
  {
    $body = Table::body($this->body)->ignore('foo', 'bar')->__toString();
    $matcher = '<tbody><tr><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testOrder()
  {
    $body = Table::body($this->body)->order('kal', 'bar', 'foo')->__toString();
    $matcher = '<tbody><tr><td class="column-kal">kal</td><td class="column-bar">bar</td><td class="column-foo">foo</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testOrderIgnore()
  {
    $body = Table::body($this->body)->ignore('foo')->order('kal')->__toString();
    $matcher = '<tbody><tr><td class="column-kal">kal</td><td class="column-bar">bar</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testDynamicColumn()
  {
    $body = Table::body(array(array('foo' => 'bar')))->fur('var')->__toString();
    $matcher = '<tbody><tr><td class="column-foo">bar</td><td class="column-fur">var</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testReplaceColumns()
  {
    $body = Table::body(array(array('foo' => 'foo')))->foo('bar')->__toString();
    $matcher = '<tbody><tr><td class="column-foo">bar</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testUnderscoreReplacement()
  {
    $body = Table::body(array(array('foo_bar' => 'foo')))->foo_bar('bar')->bar_foo('foo')->__toString();
    $matcher = '<tbody><tr><td class="column-foo_bar">bar</td><td class="column-bar foo">foo</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testAlwaysIgnore()
  {
      $app = Mockery::mock('Illuminate\Container\Container');
      $config = Mockery::mock('Config');
      $config->shouldReceive('get')->with('bootstrapper::table.ignore')->andReturn(array('foo', 'bar'));
      $app->shouldReceive('make')->with('config')->andReturn($config);
      \Bootstrapper\Helpers::setContainer($app);
      $body = Table::body($this->body)->__toString();
      $matcher = '<tbody><tr><td class="column-kal">kal</td></tr></tbody>';

      $this->assertEquals($matcher, $body);
  }

  public function testAlwaysIgnoreOverridesManuallyIgnore()
  {
    $body = Table::body($this->body)->ignore('bar')->__toString();
    $matcher = '<tbody><tr><td class="column-foo">foo</td><td class="column-kal">kal</td></tr></tbody>';

    $this->assertEquals($matcher, $body);
  }

  public function testNoReplaceMagicMethod() {

      // I am unsure as to the purpose of this...
      $table = Table::table()->body(array(array()))->__noreplace__foo_bar("Baz");
      $this->assertEquals('<tbody><tr><td class="column-foo_bar">Baz</td></tr></tbody>', $table->render(), "Just checking!");

  }
}
