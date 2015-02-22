<?php

namespace spec\DummyClasses\Bridges\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigInterfaceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DummyClasses\Bridges\Config\ConfigInterface');
        $this->shouldHaveType('Bootstrapper\Bridges\Config\ConfigInterface');
    }

    function it_has_a_method_for_getting_the_icon_prefix()
    {
        $this->getIconPrefix()->shouldReturn('glyphicon');
    }

    function it_has_a_method_of_getting_the_bootstrapper_version()
    {
        $this->getBootstrapperVersion()->shouldReturn('3.2.1');
    }

    function it_has_a_method_of_getting_the_jquery_version()
    {
        $this->getJQueryVersion()->shouldReturn('3.2.1');
    }
}
