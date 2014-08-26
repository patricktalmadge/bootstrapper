<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BootstrapperServiceProviderSpec extends ObjectBehavior
{
    function let()
    {
        $app = \Mockery::mock('Illuminate\Foundation\Application');
        $this->beConstructedWith($app);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\BootstrapperServiceProvider');
    }
}