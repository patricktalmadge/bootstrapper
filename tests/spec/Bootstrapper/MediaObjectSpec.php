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
        $this->shouldThrow('Bootstrapper\\Exceptions\\MediaObjectException')->duringRender();
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
        ])->render()->shouldBe("<ul class='media-list'><li class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li><li class='media'><a href='link' class='pull-left'><img class='media-object' src='image' alt='heading'></a><div class='media-body'><h4 class='media-heading'>heading</h4>body</div></li></ul>");
    }
}
