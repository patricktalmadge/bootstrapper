<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThumbnailSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Thumbnail');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    function it_cannot_be_rendered_without_an_image()
    {
        $this->shouldThrow(
            'Bootstrapper\Exceptions\ThumbnailException'
        )->duringRender();
    }

    function it_can_be_given_an_image()
    {
        $this->image('foo')->render()->shouldBe(
            "<div class='thumbnail'><img src='foo'></div>"
        );
    }

    function it_can_be_given_an_caption()
    {
        $this->image('foo')->caption('<div>caption</div>')->render()->shouldBe(
            "<div class='thumbnail'><img src='foo'><div class='caption'><div>caption</div></div></div>"
        );
    }

    function it_allows_you_to_give_attributes_to_the_image()
    {
        $this->image('foo', ['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='thumbnail'><img src='foo' data-foo='bar'></div>"
        );
    }
}
