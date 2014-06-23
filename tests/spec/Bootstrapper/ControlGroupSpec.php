<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ControlGroupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\ControlGroup');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='form-group'></div>");
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='form-group' data-foo='bar'></div>"
        );
    }

    function it_can_be_given_contents()
    {
        $this->withContents('<div>contents</div>')->render()->shouldBe(
            "<div class='form-group'><div>contents</div></div>"
        );
    }

    function it_can_be_given_contents_as_an_array()
    {
        $this->withContents(['<div>one</div>', '<div>two</div>'])->render()->shouldBe(
            "<div class='form-group'><div>one</div><div>two</div></div>"
        );
    }

    function it_can_be_given_a_label()
    {
        $this->withLabel('foo')->render()->shouldBe(
            "<div class='form-group'><div class='col-sm-2'>foo</div><div class='col-sm-10'></div></div>"
        );
    }

    function it_can_be_given_a_label_with_a_size()
    {
        $this->withLabel('foo', 4)->render()->shouldBe(
            "<div class='form-group'><div class='col-sm-4'>foo</div><div class='col-sm-8'></div></div>"
        );
    }

    function it_can_be_given_a_help_block()
    {
        $this->withHelp('foo')->render()->shouldBe("<div class='form-group'>foo</div>");
    }

    function it_places_the_help_block_in_the_correct_place()
    {
        $this->withLabel('bar')->withHelp('foo')->render()->shouldBe("<div class='form-group'><div class='col-sm-2'>bar</div><div class='col-sm-10'>foo</div></div>");
    }

    function it_can_be_generated_in_one_go()
    {
        $this->generate('<div>label</div>', '<div>control</div>', '<div>help</div>')->render()->shouldBe("<div class='form-group'><div class='col-sm-2'><div>label</div></div><div class='col-sm-10'><div>control</div><div>help</div></div></div>");
    }

    function it_squawks_if_the_label_size_is_silly()
    {
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', 13);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', -1);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', -0);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', 12);
    }
}
