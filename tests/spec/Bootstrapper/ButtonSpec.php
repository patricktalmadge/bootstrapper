<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ButtonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Button');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<button type='button' class='btn btn-default'></button>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['primary', 'success', 'info', 'warning', 'danger', 'link'];

        foreach ($types as $type) {
            $this->$type()->render()->shouldBe("<button type='button' class='btn btn-{$type}'></button>");
        }
    }

    function it_can_be_made_a_block_button()
    {
        $this->block()->render()->shouldBe("<button type='button' class='btn btn-default btn-block'></button>");
    }

    function it_can_be_made_a_submit_button()
    {
        $this->submit()->render()->shouldBe("<button type='submit' class='btn btn-default'></button>");
    }

    function it_can_be_made_a_reset_button()
    {
        $this->reset()->render()->shouldBe("<button type='reset' class='btn btn-default'></button>");
    }

    function it_can_be_given_a_value()
    {
        $this->withValue('foo')->render()->shouldBe("<button type='button' class='btn btn-default'>foo</button>");
    }

    function it_can_be_given_an_icon()
    {
        $this->withIcon('bar')->render()->shouldBe(
            "<button type='button' class='btn btn-default'><span class='glyphicon glyphicon-bar'></span></button>"
        );

        $this->withValue('foo')->withIcon('bar')->render()->shouldBe(
            "<button type='button' class='btn btn-default'>foo <span class='glyphicon glyphicon-bar'></span></button>"
        );
    }

    function it_can_be_sized()
    {
        $sizes = ['large' => 'btn-lg', 'small' => 'btn-sm', 'extraSmall' => 'btn-xs'];

        foreach ($sizes as $size => $class) {
            $this->$size()->render()->shouldBe("<button type='button' class='btn btn-default {$class}'></button>");
        }
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<button type='button' class='btn btn-default' data-foo='bar'></button>"
        );
    }

    function it_can_have_attributes_added()
    {
        $this->withAttributes(['data-foo' => 'bar'])->addAttributes(['data-baz' => 'goo'])->render()->shouldBe(
            "<button type='button' class='btn btn-default' data-baz='goo' data-foo='bar'></button>"
        );
    }

    function it_allows_you_to_use_a_shortcut_method()
    {
        $types = ['primary', 'success', 'info', 'warning', 'danger', 'link'];

        foreach ($types as $type) {
            $this->$type($type)->render()->shouldBe("<button type='button' class='btn btn-{$type}'>{$type}</button>");
        }
    }

}
