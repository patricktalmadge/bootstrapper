<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MediaObjectSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\MediaObject');
    }

    function it_cant_be_rendered_without_contents()
    {
        $this->shouldThrow(
            'Bootstrapper\\Exceptions\\MediaObjectException'
        )->duringRender();
    }

    function it_can_be_given_contents()
    {
        $this->withContents(
            [
                'image' => 'image',
                'link' => 'link',
                'heading' => 'heading',
                'body' => 'body'
            ]
        )->render()->shouldBe(
            "<div class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></div>"
        );
    }

    function it_can_become_a_list_and_be_rendered()
    {
        $this->asList()->render("<ul class='media-list'></ul>");
    }

    function it_is_clever_enough_to_become_a_list()
    {
        $this->withContents(
            [
                [
                    'image' => 'image',
                    'link' => 'link',
                    'heading' => 'heading',
                    'body' => 'body'
                ],
                [
                    'image' => 'image',
                    'link' => 'link',
                    'heading' => 'heading',
                    'body' => 'body'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='media-list'><li class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li><li class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li></ul>"
        );
    }

    function it_can_place_the_image_on_the_left_or_right()
    {
        $this->withContents(
            [
                [
                    'image' => 'image',
                    'link' => 'link',
                    'heading' => 'heading',
                    'body' => 'body',
                    'position' => 'left'
                ],
                [
                    'image' => 'image',
                    'link' => 'link',
                    'heading' => 'heading',
                    'body' => 'body',
                    'position' => 'right'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='media-list'><li class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li><li class='media'><a href='link' class='pull-right'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li></ul>"
        );
    }

    function it_can_handle_an_object_without_some_fields()
    {
        $this->withContents(
            [
                'image' => 'image',
                'body' => 'body'
            ]
        )->render()->shouldBe(
            "<div class='media'><div class='pull-left'><img class='media-object' src='image'></div><div class='media-body'>body</div></div>"
        );
    }

    function it_hates_you_if_you_dont_pass_in_an_image_or_body()
    {
        $this->withContents(['image' => 'image'])->shouldThrow(
            'Bootstrapper\\Exceptions\\MediaObjectException'
        )->duringRender();
        $this->withContents(['body' => 'body'])->shouldThrow(
            'Bootstrapper\\Exceptions\\MediaObjectException'
        )->duringRender();
    }

    function it_supports_nesting()
    {
        $this->withContents(
            [
                'image' => 'image',
                'body' => 'body',
                'nest' => [
                    'image' => 'image',
                    'body' => 'body'
                ]
            ]
        )->render()->shouldBe(
            "<div class='media'><div class='pull-left'><img class='media-object' src='image'></div><div class='media-body'>body<div class='media'><div class='pull-left'><img class='media-object' src='image'></div><div class='media-body'>body</div></div></div></div>"
        );
    }
}
