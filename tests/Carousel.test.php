<?php
class CarouselTest extends BootstrapperWrapper
{
  private function carouselMarkup($html)
  {
    $matcherLeft = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'foo carousel slide',
        'data-foo' => 'bar'
      ),
      'descendant' => array(
        'tag' => 'a',
        'attributes' => array(
          'class' => 'carousel-control left',
          'data-slide' => 'prev',
        ),
        'content' => '‹',
      )
    );
    $matcherRight = array(
      'tag' => 'div',
      'descendant' => array(
        'tag' => 'a',
        'attributes' => array(
          'class' => 'carousel-control right',
          'data-slide' => 'next',
        ),
        'content' => '›',
      )
    );
    $matcherSlide = array(
      'tag' => 'div',
      'descendant' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'carousel-inner'),
        'children' => array(
          'count' => 4,
          'only' => array(
            'tag' => 'div',
            'attributes' => array('class' => 'item'),
            'descendant' => array('tag' => 'img'),
          ),
        ),
      )
    );

    $this->assertTag($matcherLeft,   $html);
    $this->assertTag($matcherRight,  $html);
    $this->assertTag($matcherSlide,  $html);
  }

  public function testCreateSimple()
  {
    $carousel = Carousel::create(array('foo', 'bar', 'kal', 'tem'), $this->testAttributes);

    $this->carouselMarkup($carousel);
  }

  public function testCarouselComplex()
  {
    $carousel = Carousel::create(array(
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
      array('image' => 'foo', 'alt_text' => 'bar', 'caption' => 'caption', 'label' => 'label', 'attributes' => $this->testAttributes),
    ), $this->testAttributes);

  }
}