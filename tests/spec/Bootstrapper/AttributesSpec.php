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

    function it_can_be_constructed_and_overwrite_defaults()
    {
        $this->beConstructedWith(['foo' => 'bar'], ['foo' => 'baz']);

        $this->__toString()->shouldBe("foo='bar'");
    }

    function it_escapes_the_values()
    {
        $value = "A<'>J";
        $this['foo'] = $value;

        $this->__toString()->shouldBe("foo='A&lt;\'&gt;J'");
    }

    function it_can_handle_no_keys()
    {
        $this->beConstructedWith(['foo']);

        $this->__toString()->shouldBe('foo');
    }

    function it_can_handle_an_empty_value()
    {
        $this->beConstructedWith(['foo' => '']);

        $this->__toString()->shouldBe('');
    }

    function it_concatenates_classes()
    {
        $this->beConstructedWith(['class' => 'foo'], ['class' => 'bar']);

        $this->__toString()->shouldBe("class='bar foo'");
    }

    function it_can_add_classes()
    {
        $this->beConstructedWith(['class' => 'bar']);

        $this->addClass('foo')->__toString()->shouldBe("class='bar foo'");
    }

}
