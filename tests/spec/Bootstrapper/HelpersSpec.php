<?php

namespace spec\Bootstrapper;

use Bootstrapper\Bridges\Config\ConfigInterface;
use Bootstrapper\RenderedObject;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HelpersSpec extends ObjectBehavior
{
    function let(ConfigInterface $configInterface)
    {
        $configInterface->getJQueryVersion()->willReturn("2.1.0");
        $configInterface->getBootstrapperVersion()->willReturn("3.1.1");

        $this->beConstructedWith($configInterface);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Helpers');
    }

    function it_can_generate_a_css_tag_for_us()
    {
        $this->css()->shouldBe(
            "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'><link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css'>"
        );
    }

    function it_can_give_us_just_the_css_without_the_theme()
    {
        $this->css(false)->shouldBe(
            "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>"
        );
    }

    function it_can_give_us_the_script_tags()
    {
        $this->js()->shouldBe(
            "<script src='//code.jquery.com/jquery-2.1.0.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>"
        );
    }

    function it_listens_to_the_config_file(ConfigInterface $configInterface)
    {
        $configInterface->getJQueryVersion()->willReturn("2.1.1");
        $configInterface->getBootstrapperVersion()->willReturn("3.2.1");

        $this->css()->shouldBe(
            "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.2.1/css/bootstrap.min.css'><link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.2.1/css/bootstrap-theme.min.css'>"
        );
        $this->js()->shouldBe(
            "<script src='//code.jquery.com/jquery-2.1.1.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/3.2.1/js/bootstrap.min.js'></script>"
        );
    }

    function it_generates_a_sensible_id_for_an_object()
    {
        $this->generateId(new FooRenderedObject())->shouldReturn
        (
            '1-spec-bootstrapper-foorenderedobject-1'
        );
        $this->generateId(new FooRenderedObject())->shouldReturn(
            '2-spec-bootstrapper-foorenderedobject-2'
        );

        $this->generateId(new BarRenderedObject())->shouldReturn
        (
            '1-spec-bootstrapper-barrenderedobject-1'
        );
    }

}

class FooRenderedObject extends RenderedObject
{
    public function render()
    {
    }
}

class BarRenderedObject extends RenderedObject
{
    public function render()
    {
    }
}