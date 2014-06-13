<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributesSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Attributes');
    }

    function it_can_be_turned_into_a_string()
    {
        $this->beConstructedWith(['foo' => 'bar']);

        $this->__toString()->shouldBe("foo='bar'");
    }

    function it_can_take_defaults()
    {
        $this->beConstructedWith([], ['foo' => 'bar']);

        $this->__toString()->shouldBe("foo='bar'");
    }

    function it_can_be_accessed_like_an_array()
    {
        $this->beConstructedWith(['foo' => 'bar']);

        $this['foo'] = 'baz';
        $this->__toString()->shouldBe("foo='baz'");
    }
}
