<?php
class CarouselTest extends BootstrapperWrapper
{
  private $images = array(
    'foo', 'bar', 'kal', 'tem',
  );

  public function testCreate()
  {
    $carousel = Carousel::create($this->images, $this->testAttributes);
  }
}