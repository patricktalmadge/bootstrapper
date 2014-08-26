<?php

namespace spec\Bootstrapper;

use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IconSpec extends ObjectBehavior
{
    function let()
    {
        $mock = Mockery::mock('Illuminate\\Config\\Repository');
        $mock->shouldReceive('get')->with('bootstrapper::icon_prefix')->andReturn('glyphicon');
        $this->beConstructedWith($mock);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Icon');
    }

    function it_can_create_an_icon()
    {
        $this->create('foo')->shouldReturn("<span class='glyphicon glyphicon-foo'></span>");
    }

    function it_listens_to_the_config_file()
    {
        $mock = Mockery::mock('Illuminate\\Config\\Repository');
        $mock->shouldReceive('get')->with('bootstrapper::icon_prefix')->andReturn('bar');
        $this->beConstructedWith($mock);

        $this->create('foo')->shouldReturn("<span class='bar bar-foo'></span>");
    }

    function it_can_be_created_magically()
    {
        $types = ['foo', 'bar', 'baz'];

        foreach ($types as $type) {
            $this->$type()->shouldReturn("<span class='glyphicon glyphicon-$type'></span>");
        }
    }
}
