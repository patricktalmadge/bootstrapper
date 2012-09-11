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

  /**
   * Creates the HTML structure of an image
   *
   * @param  string $class The class to apply
   * @return array         An <img> tag matcher
   */
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

  public function testRounded()
  {
    $image = Images::rounded($this->url, 'foo', array('data-foo' => 'bar'));
    $matcher = $this->createMatcher('rounded');

    $this->assertTag($matcher, $image);
  }

  public function testCircle()
  {
    $image = Images::circle($this->url, 'foo', array('data-foo' => 'bar'));
    $matcher = $this->createMatcher('circle');

    $this->assertTag($matcher, $image);
  }

  public function testPolaroid()
  {
    $image = Images::polaroid($this->url, 'foo', array('data-foo' => 'bar'));
    $matcher = $this->createMatcher('polaroid');

    $this->assertTag($matcher, $image);
  }
}