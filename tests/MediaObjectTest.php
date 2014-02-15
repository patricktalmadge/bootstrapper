<?php
include_once '_start.php';

use Bootstrapper\MediaObject;

class MediaObjectTest extends BootstrapperWrapper
{
  public function createMatcher($image = null, $pull = null, $title = null)
  {
    if(!$image) $image = '<img src="http://test/bar" class="media-object" alt="bar">';
    if(!$pull) $pull ='left';

    return
      '<div class="foo media" data-foo="bar">'.
        '<a class="pull-' .$pull. '">'.
          $image.
        '</a>'.
        '<div class="media-body">'.
          $title.
          'foo'.
        '</div>'.
      '</div>';
  }

  public function titles()
  {
    $titles = array();
    for ($i = 1; $i <= 6; $i++) {
      $titles[] = array(
        'with_h'.$i,
        '<h'.$i.' class="foo media-heading" data-foo="bar">foobar</h'.$i.'>',
      );
    }

    return $titles;
  }

  public function tearDown()
  {
    parent::tearDown();

    MediaObject::close_list();
    MediaObject::$object = null;
  }

  public function testOpenList()
  {
    
    $open = MediaObject::open_list($this->testAttributes);
    $matcher = '<ul class="foo media-list" data-foo="bar">';

    $this->assertEquals($matcher, $open);
  }

  public function testCloseList()
  {
    
    $close = MediaObject::close_list();
    $matcher = '</ul>';

    $this->assertEquals($matcher, $close);
  }

  public function testBaseMediaObject()
  {
    
    $media = MediaObject::create('foo', 'bar', $this->testAttributes)->__toString();
    $matcher = $this->createMatcher();

    $this->assertEquals($matcher, $media);
  }

  public function testWithImage()
  {
    
    $media = MediaObject::create('foo', null, $this->testAttributes)
      ->with_image('bar', 'alt', $this->testAttributes)->__toString();
    $matcher = $this->createMatcher('<img src="http://test/bar" class="foo media-object" data-foo="bar" alt="alt">');

    $this->assertEquals($matcher, $media);
  }

  public function testPullLeft()
  {
    
    $media1 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull_left()->__toString();
    $media2 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull('left')->__toString();
    $matcher = $this->createMatcher();

    $this->assertEquals($matcher, $media1);
    $this->assertEquals($matcher, $media2);
  }

  public function testPullRight()
  {
    
    $media1 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull_right()->__toString();
    $media2 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull('right')->__toString();
    $matcher = $this->createMatcher(null, 'right');

    $this->assertEquals($matcher, $media1);
    $this->assertEquals($matcher, $media2);
  }

  public function testPullWhatever()
  {
    
    $media1 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull_whatever()->__toString();
    $media2 = MediaObject::create('foo', 'bar', $this->testAttributes)->pull('whatever')->__toString();
    $matcher = $this->createMatcher();

    $this->assertEquals($matcher, $media1);
    $this->assertEquals($matcher, $media2);
  }

  public function testWithTitle()
  {
    
    $media = MediaObject::create('foo', 'bar', $this->testAttributes)->with_title('<h1>foobar</h1>')->__toString();
    $matcher = $this->createMatcher(null, null, '<h1>foobar</h1>');

    $this->assertEquals($matcher, $media);
  }

  /**
   * @dataProvider titles
   */
  public function testMagicTitles($title, $expected)
  {
    
    $media = MediaObject::create('foo', 'bar', $this->testAttributes)->$title('foobar', $this->testAttributes)->__toString();
    $matcher = $this->createMatcher(null, null, $expected);

    $this->assertEquals($matcher, $media);
  }

  public function testNesting()
  {
    
    $media = MediaObject::create('foo', 'bar', $this->testAttributes)
      ->nest(MediaObject::create('foo2', 'bar2')->with_h1('foobar'))
      ->__toString();
    $matcher =
    '<div class="foo media" data-foo="bar">'.
      '<a class="pull-left"><img src="http://test/bar" class="media-object" alt="bar"></a>'.
      '<div class="media-body">foo'.
        '<div class="media">'.
          '<a class="pull-left"><img src="http://test/bar2" class="media-object" alt="bar2"></a>'.
          '<div class="media-body"><h1 class="media-heading">foobar</h1>foo2</div>'.
        '</div>'.
      '</div>'.
    '</div>';

    $this->assertEquals($matcher, $media);
  }

}
