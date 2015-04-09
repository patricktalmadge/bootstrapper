<?php

namespace spec\Bootstrapper;

use Bootstrapper\Bridges\Config\ConfigInterface;
use Bootstrapper\Exceptions\IconException;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IconSpec extends ObjectBehavior
{
    function let(ConfigInterface $configInterface)
    {
        $configInterface->getIconPrefix()->willReturn('glyphicon');

        $this->beConstructedWith($configInterface);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Icon');
    }

    function it_can_create_an_icon()
    {
        $this->create('foo')->render()->shouldReturn(
            "<span class='glyphicon glyphicon-foo'></span>"
        );
    }

    function it_listens_to_the_config_file(ConfigInterface $configInterface)
    {
        $configInterface->getIconPrefix()->willReturn('bar');

        $this->create('foo')->render()->shouldReturn("<span class='bar bar-foo'></span>");
    }

    function it_can_be_created_magically()
    {
        $types = ['foo', 'bar', 'baz'];

        foreach ($types as $type) {
            $this->$type()->render()->shouldReturn(
                "<span class='glyphicon glyphicon-$type'></span>"
            );
        }
    }

    function it_can_create_an_icon_from_camel_case()
    {
        $this->create('fooBar')->render()->shouldReturn(
            "<span class='glyphicon glyphicon-foo-bar'></span>"
        );
    }

    function it_can_create_an_icon_from_underscore()
    {
        $this->create('foo_bar')->render()->shouldReturn(
            "<span class='glyphicon glyphicon-foo-bar'></span>"
        );
    }

    function it_allows_you_to_add_attributes()
    {
        $this->create('foo')->withAttributes(['foo' => 'bar'])->render()->shouldReturn(
            "<span class='glyphicon glyphicon-foo' foo='bar'></span>"
        );
    }
    
    function it_blows_up_if_you_dont_use_the_create()
    {
        $this->withAttributes(['foo' => 'bar'])->shouldThrow(
            IconException::noIconSpecified()
        )->duringRender();
    }

    function it_allows_you_to_add_attributes_magically()
    {
        $types = ['foo', 'bar', 'baz'];

        foreach ($types as $type) {
            $this->$type()->withAttributes([
                'foo' => 'bar'
            ])->render()->shouldReturn(
                "<span class='glyphicon glyphicon-$type' foo='bar'></span>"
            );
        }
    }
}
