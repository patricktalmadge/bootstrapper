<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Image');
    }

    function it_cant_be_rendered_without_an_image()
    {
        $this->shouldThrow('Bootstrapper\\Exceptions\\ImageException')->duringRender();
    }

    function it_can_be_given_an_image()
    {
        $this->withSource('foo')->render()->shouldBe("<img src='foo'>");
    }

    function it_can_be_given_alt_text()
    {
        $this->withSource('foo')->withAlt('bar')->render()->shouldBe("<img src='foo' alt='bar'>");
    }

    function it_can_be_given_attributes()
    {
        $this->withSource('foo')->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<img src='foo' data-foo='bar'>"
        );
    }

    function it_can_be_made_responsive()
    {
        $this->withSource('foo')->responsive()->render()->shouldBe("<img src='foo' class='img-responsive'>");
    }

    function it_can_be_made_rounded()
    {
        $this->withSource('foo')->rounded()->render()->shouldBe("<img src='foo' class='img-rounded'>");
    }

    function it_can_be_made_a_circle()
    {
        $this->withSource('foo')->circle()->render()->shouldBe("<img src='foo' class='img-circle'>");
    }

    function it_can_be_made_a_thumbnail()
    {
        $this->withSource('foo')->thumbnail()->render()->shouldBe("<img src='foo' class='img-thumbnail'>");
    }

    function it_has_shortcut_methods()
    {
        $types = ['rounded', 'thumbnail', 'circle'];

        foreach($types as $type)
        {
            // Clears out everything
            $this->withAttributes([]);
            $this->withSource('');
            $this->withAlt('');
            $this->$type('foo', 'bar')->render()->shouldBe("<img src='foo' alt='bar' class='img-{$type}'>");
        }
    }
}
