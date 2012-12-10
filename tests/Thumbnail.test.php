<?php
use Bootstrapper\Thumbnail;

class ThumbnailTest extends BootstrapperWrapper
{
  private $images = array('foo', 'bar');

  private $linkedImages = array(
    array('image' => 'foo', 'link' => 'foo'),
    array('image' => 'bar', 'link' => 'foo'),
  );

  private $richImages = array(
    array('image' => 'foo', 'caption' => 'kel'),
    array('image' => 'bar', 'label' => 'bar'),
    array('image' => 'den', 'label' => 'den', 'caption' => 'kel'),
  );

  public static function setUpBeforeClass()
  {
    URL::$base = 'http://test/';
    Config::set('application.index', '');
    Config::set('application.asset_url', 'test');
  }

  // Matchers ------------------------------------------------------ /

  public function matcher($thumbnails)
  {
    return '<ul class="thumbnails">' .$thumbnails. '</ul>';
  }

  public function image($image)
  {
    return '<img src="test/'.$image.'" alt="">';
  }

  public function link($content)
  {
    return '<a href="http://test/foo" class="thumbnail">' .$content. '</a>';
  }

  // Tests --------------------------------------------------------- /

  public function testSimpleThumbnails()
  {
    $thumbnails = Thumbnail::create($this->images);
    $matcher = $this->matcher(
      '<li class="thumbnail">'.$this->image('foo').'</li>'.
      '<li class="thumbnail">'.$this->image('bar').'</li>'
    );

    $this->assertEquals($matcher, $thumbnails);
  }

  public function testAlreadyWrappedThumbnails()
  {
    $images = array($this->image('foo'), $this->image('bar'));
    $thumbnails = Thumbnail::create($images);
    $matcher = $this->matcher(
      '<li class="thumbnail">'.$this->image('foo').'</li>'.
      '<li class="thumbnail">'.$this->image('bar').'</li>'
    );

    $this->assertEquals($matcher, $thumbnails);
  }

  public function testLinkedThumbnails()
  {
    $thumbnails = Thumbnail::create($this->linkedImages);
    $matcher = $this->matcher(
      '<li>'.$this->link($this->image('foo')).'</li>'.
      '<li>'.$this->link($this->image('bar')).'</li>'
    );

    $this->assertEquals($matcher, $thumbnails);
  }

  public function testRichThumbnails()
  {
    $thumbnails = Thumbnail::create($this->richImages);
    $matcher = $this->matcher(
      '<li><div class="thumbnail">'.$this->image('foo').'<p>kel</p></div></li>'.
      '<li><div class="thumbnail">'.$this->image('bar').'<h3>bar</h3></div></li>'.
      '<li><div class="thumbnail">'.$this->image('den').'<h3>den</h3><p>kel</p></div></li>'
    );

    $this->assertEquals($matcher, $thumbnails);
  }

  public function testWithClosure()
  {
    $thumbnails = Thumbnail::create($this->richImages, function($image) {
      $image = (object) $image;

      $return = '<li class="thumbnail"><figure>' .HTML::image($image->image). '</figure>';
      if(isset($image->label)) $return .= '<h2>'.$image->label.'</h2>';
      $return .= '</li>';

      return $return;
    });
    $matcher = $this->matcher(
      '<li class="thumbnail"><figure>'.$this->image('foo').'</figure></li>'.
      '<li class="thumbnail"><figure>'.$this->image('bar').'</figure><h2>bar</h2></li>'.
      '<li class="thumbnail"><figure>'.$this->image('den').'</figure><h2>den</h2></li>'
    );

    $this->assertEquals($matcher, $thumbnails);
  }
}
