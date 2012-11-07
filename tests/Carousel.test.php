<?php
use Bootstrapper\Carousel;

class CarouselTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  /**
   * Basic structure of a Carousel item
   * @var array
   */
  private $innerItem = array(
    'tag' => 'div',
    'child' => array(
      'tag' => 'div',
      'attributes' => array('class' => 'carousel-inner'),
      'children' => array(
        'count' => 4,
        'only' => array(
          'tag' => 'div',
          'attributes' => array('class' => 'item'),
          'child' => array('tag' => 'img'),
        )
      )
    )
  );

  /**
   * Match the basic structure of a Carousel
   *
   * @param  string $html A carousel markup
   */
  private function carouselMarkup($html)
  {
    // Matcher for the left navigation element
    $matcherLeft = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'foo carousel slide',
        'data-foo' => 'bar'
      ),
      'child' => array(
        'tag' => 'a',
        'content' => '‹',
        'attributes' => array(
          'class' => 'carousel-control left',
          'data-slide' => 'prev',
        ),
      )
    );

    // Matcher for the right navigation element
    $matcherRight = array(
      'tag' => 'div',
      'child' => array(
        'tag' => 'a',
        'content' => '›',
        'attributes' => array(
          'class' => 'carousel-control right',
          'data-slide' => 'next',
        ),
      )
    );

    $this->assertTag($matcherLeft,   $html);
    $this->assertTag($matcherRight,  $html);
  }

  // Tests --------------------------------------------------------- /

  public function testCreateSimple()
  {
    $carousel = Carousel::create(array('foo', 'bar', 'kal', 'tem'), $this->testAttributes);

    // Matcher for the slides
    $matcherSlide = $this->innerItem;

    $this->carouselMarkup($carousel);
    $this->assertTag($matcherSlide, $carousel);
  }

  public function testCarouselComplex()
  {
    $carousel = Carousel::create(array(
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
    ), $this->testAttributes);

    // Matcher for the slides
    $matcherSlide = $this->innerItem;
    $matcherSlide['child']['children']['only']['child']['attributes'] = array(
      'alt'      => 'bar',
      'class'    => 'foo',
      'data-foo' => 'bar',
    );

    // Matcher for the captions
    $matcherCaption = $this->innerItem;
    $matcherCaption['child']['children'] = array(
      'count' => 4,
      'only' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'item'),
        'child' => array(
          'tag' => 'div',
          'attributes' => array('class' => 'carousel-caption'),
          'child'      => array('tag' => 'h4', 'content' => 'label'),
          'descendant' => array('tag' => 'p', 'content' => 'caption'),
        )
      )
    );

    $this->carouselMarkup($carousel);
    $this->assertTag($matcherSlide, $carousel);
    $this->assertTag($matcherCaption, $carousel);
  }
}
