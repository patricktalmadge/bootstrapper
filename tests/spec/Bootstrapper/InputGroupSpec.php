<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InputGroupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\InputGroup');
    }

    function it_can_be_given_contents()
    {
        $this->withContents('<div>input</div>')->render()->shouldBe(
            "<div class='input-group'><div>input</div></div>"
        );
    }

    function it_can_prepend()
    {
        $this->withContents('<div>input</div>')->prepend('foo')->render(
        )->shouldBe(
            "<div class='input-group'><span class='input-group-addon'>foo</span><div>input</div></div>"
        );
    }

    function it_can_append()
    {
        $this->withContents('<div>input</div>')->append('foo')->render(
        )->shouldBe(
            "<div class='input-group'><div>input</div><span class='input-group-addon'>foo</span></div>"
        );
    }

    function it_can_be_sized()
    {
        $sizes = ['large' => 'input-group-lg', 'small' => 'input-group-sm'];

        foreach ($sizes as $size => $class) {
            $this->$size()->render()->shouldBe(
                "<div class='input-group {$class}'></div>"
            );
        }

    }

    function it_can_append_buttons()
    {
        $this->withContents('<div>input</div>')->appendButton('foo')->render(
        )->shouldBe(
            "<div class='input-group'><div>input</div><span class='input-group-btn'>foo</span></div>"
        );
    }

    function it_can_prepend_buttons()
    {
        $this->withContents('<div>input</div>')->prependButton('foo')->render(
        )->shouldBe(
            "<div class='input-group'><span class='input-group-btn'>foo</span><div>input</div></div>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='input-group' data-foo='bar'></div>"
        );
    }

}
