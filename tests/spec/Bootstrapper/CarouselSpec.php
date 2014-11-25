<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CarouselSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Carousel');
    }

    function it_can_be_named()
    {
        $this->named('foo')->render()->shouldBe(
            "<div id='foo' class='carousel slide' data-ride='carousel'><ol class='carousel-indicators'></ol><div class='carousel-inner'></div><a class='left carousel-control' href='#foo' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#foo' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a></div>"
        );
    }

    function it_does_now_squawk_if_a_name_isnt_given()
    {
        $this->render()->shouldBe(
            "<div id='1-bootstrapper-carousel-1' class='carousel slide' data-ride='carousel'><ol class='carousel-indicators'></ol><div class='carousel-inner'></div><a class='left carousel-control' href='#1-bootstrapper-carousel-1' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#1-bootstrapper-carousel-1' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a></div>"
        );
    }

    function it_can_be_given_contents()

    {
        $this->named('foo')->withContents(
            [
                [
                    'image' => 'foo',
                    'caption' => 'foo',
                    'alt' => 'foo'
                ],
                [
                    'image' => 'bar',
                    'caption' => 'bar',
                    'alt' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<div id='foo' class='carousel slide' data-ride='carousel'><ol class='carousel-indicators'><li data-target='#foo' data-slide-to='0' class='active'></li><li data-target='#foo' data-slide-to='1'></li></ol><div class='carousel-inner'><div class='item active'><img src='foo' alt='foo'><div class='carousel-caption'>foo</div></div><div class='item'><img src='bar' alt='bar'><div class='carousel-caption'>bar</div></div></div><a class='left carousel-control' href='#foo' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#foo' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a></div>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->named('foo')->withAttributes(['foo' => 'bar'])->render(
        )->shouldBe(
            "<div id='foo' class='carousel slide' data-ride='carousel' foo='bar'><ol class='carousel-indicators'></ol><div class='carousel-inner'></div><a class='left carousel-control' href='#foo' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#foo' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a></div>"
        );
    }

    function it_allows_you_to_skip_the_caption()
    {
        $this->named('foo')->withContents(
            [
                [
                    'image' => 'foo',
                    'alt' => 'foo'
                ],
                [
                    'image' => 'bar',
                    'alt' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<div id='foo' class='carousel slide' data-ride='carousel'><ol class='carousel-indicators'><li data-target='#foo' data-slide-to='0' class='active'></li><li data-target='#foo' data-slide-to='1'></li></ol><div class='carousel-inner'><div class='item active'><img src='foo' alt='foo'></div><div class='item'><img src='bar' alt='bar'></div></div><a class='left carousel-control' href='#foo' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a><a class='right carousel-control' href='#foo' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a></div>"
        );

    }

    function it_allows_you_to_override_the_buttons()
    {
        $this->named('foo')->withControls('<div>previous</div>', '<div>next</div>')->render()->shouldBe(
            "<div id='foo' class='carousel slide' data-ride='carousel'><ol class='carousel-indicators'></ol><div class='carousel-inner'></div><a class='left carousel-control' href='#foo' data-slide='prev'><div>previous</div></a><a class='right carousel-control' href='#foo' data-slide='next'><div>next</div></a></div>"
        );
    }

}