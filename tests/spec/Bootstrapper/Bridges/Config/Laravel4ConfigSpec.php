<?php

namespace spec\Bootstrapper\Bridges\Config;

use Illuminate\Config\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Laravel4ConfigSpec extends ObjectBehavior
{
    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Bridges\Config\Laravel4Config');
        $this->shouldHaveType('Bootstrapper\Bridges\Config\ConfigInterface');
    }

    function it_has_a_method_for_getting_the_icon_prefix(Repository $repository)
    {
        $repository->get('bootstrapper::icon_prefix')
            ->willReturn('glyphicon')
            ->shouldBeCalled(1);

        $this->getIconPrefix()->shouldReturn('glyphicon');
    }

    function it_has_a_method_for_getting_the_icon_tag(Repository $repository)
    {
        $repository->get('bootstrapper::icon_tag')
            ->willReturn('span')
            ->shouldBeCalled(1);

        $this->getIconTag()->shouldReturn('span');
    }

    function it_has_a_method_of_getting_the_bootstrapper_version(Repository $repository)
    {
        $repository->get('bootstrapper::bootstrapVersion')
            ->willReturn('3.2.1')
            ->shouldBeCalled(1);

        $this->getBootstrapperVersion()->shouldReturn('3.2.1');
    }

    function it_has_a_method_of_getting_the_jquery_version(Repository $repository)
    {
        $repository->get('bootstrapper::jqueryVersion')
            ->willReturn('3.2.1')
            ->shouldBeCalled(1);

        $this->getJQueryVersion()->shouldReturn('3.2.1');
    }

}
