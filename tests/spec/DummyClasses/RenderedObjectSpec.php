<?php

namespace spec\DummyClasses;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RenderedObjectSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DummyClasses\RenderedObject');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe('<tmp >');
    }

    function it_has_with_attributes()
    {
        $this->withAttributes(['foo' => 'bar'])->render()->shouldBe("<tmp foo='bar'>");
    }

    function it_can_add_classes()
    {
        $this->addClass(['temp'])->render()->shouldBe("<tmp class='temp'>");
    }

    function it_adds_classes_if_you_set_one_with_attributes()
    {
        $this->withAttributes(['class' => 'foo'])->addClass(['bar'])->render()->shouldBe("<tmp class='foo bar'>");
    }
}
