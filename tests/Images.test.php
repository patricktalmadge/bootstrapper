<?php
Bundle::start('bootstrapper');
use Bootstrapper\Images;

class ImagesTest extends PHPUnit_Framework_TestCase
{
  /**
   * URL example
   * @var string
   */
  private $url = 'http://www.foo.fr/bar.jpg';

  // Matchers ------------------------------------------------------ /

  private function createMatcher($class)
  {
    return array(
      'tag' => 'img',
      'attributes' => array(
        'alt'      => 'foo',
        'class'    => 'img-'.$class,
        'data-foo' => 'bar',
        'src'      => $this->url,
      ),
    );
  }

  // Data providers ------------------------------------------------ /

  public function classes()
  {
    return array(
      array('circle'),
      array('polaroid'),
      array('rounded'),
    );
  }

  // Tests --------------------------------------------------------- /

  /**
   * @dataProvider classes
   */
  public function testImages($class)
  {
    $image = call_user_func('Images::'.$class, $this->url, 'foo', array('data-foo' => 'bar'));
    $matcher = $this->createMatcher($class);

    $this->assertTag($matcher, $image);
  }
}