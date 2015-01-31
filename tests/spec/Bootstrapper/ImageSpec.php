<?php

namespace spec\Bootstrapper;

use PhpSpec\Exception\Example\ErrorException;
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
        $this->shouldThrow(
            'Bootstrapper\\Exceptions\\ImageException'
        )->duringRender();
    }

    function it_can_be_given_an_image()
    {
        $this->withSource('foo')->render()->shouldBe("<img src='foo'>");
    }

    function it_can_be_given_alt_text()
    {
        $this->withSource('foo')->withAlt('bar')->render()->shouldBe(
            "<img src='foo' alt='bar'>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->withSource('foo')->withAttributes(['data-foo' => 'bar'])->render(
        )->shouldBe(
            "<img src='foo' data-foo='bar'>"
        );
    }

    function it_can_be_made_responsive()
    {
        $this->withSource('foo')->responsive()->render()->shouldBe(
            "<img src='foo' class='img-responsive'>"
        );
    }

    function it_can_be_made_rounded()
    {
        $this->withSource('foo')->rounded()->render()->shouldBe(
            "<img src='foo' class='img-rounded'>"
        );
    }

    function it_can_be_made_a_circle()
    {
        $this->withSource('foo')->circle()->render()->shouldBe(
            "<img src='foo' class='img-circle'>"
        );
    }

    function it_can_be_made_a_thumbnail()
    {
        $this->withSource('foo')->thumbnail()->render()->shouldBe(
            "<img src='foo' class='img-thumbnail'>"
        );
    }

    function it_allows_you_to_use_rounded_as_a_shortcut_method()
    {
        $this->rounded('foo', 'bar')->render()->shouldBe(
            "<img src='foo' alt='bar' class='img-rounded'>"
        );
    }

    function it_allows_you_to_use_thumbnail_as_a_shortcut_method()
    {
        $this->thumbnail('foo', 'bar')->render()->shouldBe(
            "<img src='foo' alt='bar' class='img-thumbnail'>"
        );
    }

    function it_allows_you_to_use_circle_as_a_shortcut_method()
    {
        $this->circle('foo', 'bar')->render()->shouldBe(
            "<img src='foo' alt='bar' class='img-circle'>"
        );
    }

    function it_knows_that_add_class_with_a_string_is_depreciated()
    {
        $wasThrown = false;

        try {
            $this->addClass('test');
        } catch (ErrorException $e) {
            if (strpos($e->getMessage(), 'Passing strings to Image::getClass ' .
            'is depreciated, and will be removed in a future version of ' .
            'Bootstrapper') === false)
            {
                throw $e;
            }
            $wasThrown = true;
        }

        if (!$wasThrown) {
            throw new ErrorException(
                E_USER_WARNING,
                'Expected an error to be triggered during ' . __METHOD__,
                __FILE__,
                __LINE__
            );
        }
    }
}
