<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BadgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Badge');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<span class='badge'></span>");
    }

    function it_can_be_given_contents()
    {
        $this->withContents("foo")->render()->shouldBe("<span class='badge'>foo</span>");
    }

    function it_can_be_constructed_with_attributes()
    {
        $this->withAttributes(['class' => 'foo'])->render()->shouldBe("<span class='badge foo'></span>");
    }
}
