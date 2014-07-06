<?php

namespace spec\Bootstrapper;

use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HelpersSpec extends ObjectBehavior
{
    function let()
    {
        $config = Mockery::mock('Illuminate\Config\Repository');

        $config->shouldReceive('get')->with('bootstrapper::jqueryVersion')->andReturn("2.1.0");
        $config->shouldReceive('get')->with('bootstrapper::bootstrapVersion')->andReturn("3.1.1");

        $this->beConstructedWith($config);
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
            "<script src='http://code.jquery.com/jquery-2.1.0.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>"
        );
    }

    function it_listens_to_the_config_file()
    {
        $config = Mockery::mock('Illuminate\Config\Repository');

        $config->shouldReceive('get')->with('bootstrapper::jqueryVersion')->andReturn("2.1.1");
        $config->shouldReceive('get')->with('bootstrapper::bootstrapVersion')->andReturn("3.2.1");

        $this->beConstructedWith($config);
        $this->css()->shouldBe(
            "<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.2.1/css/bootstrap.min.css'><link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.2.1/css/bootstrap-theme.min.css'>"
        );
        $this->js()->shouldBe(
            "<script src='http://code.jquery.com/jquery-2.1.1.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/3.2.1/js/bootstrap.min.js'></script>"
        );
    }

}
